<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class LimitRequestCount
{
    /**
     * The rate limiter instance.
     *
     * @var RateLimiter
     */
    protected $limiter;

    /**
     * Create a new request throttler.
     *
     * @param RateLimiter $limiter
     * @return void
     */
    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param int $maxAttempts
     * @param int $decayMinutes
     * @return mixed
     */
    public function handle($request, Closure $next, $maxAttempts = 5, $decayMinutes = 1)
    {
        /** @var Response $response */
        $response = $next($request);

        $key = $this->resolveRequestSignature($request);

        if ($response->getStatusCode() == Response::HTTP_NOT_FOUND) {
            if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
                throw $this->buildException($key);
            }

            $this->limiter->hit($key, $decayMinutes * 60);
        }

        return $response;
    }

    /**
     * Resolve request signature.
     *
     * @param Request $request
     * @return string
     */
    protected function resolveRequestSignature($request)
    {
        return sha1($request->userAgent() . '|' . $request->ip());
    }

    /**
     * Create a 'too many attempts' exception.
     *
     * @param  string  $key
     * @return TooManyRequestsHttpException
     */
    protected function buildException($key)
    {
        $retryAfter = $this->getTimeUntilNextRetry($key);

        return new TooManyRequestsHttpException(
            $retryAfter, 'Too Many Attempts.'
        );
    }

    /**
     * Get the number of seconds until the next retry.
     *
     * @param  string  $key
     * @return int
     */
    protected function getTimeUntilNextRetry($key)
    {
        return $this->limiter->availableIn($key);
    }
}
