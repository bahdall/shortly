<?php

namespace App\Http\Middleware;

use App\Services\TokenGenerator\TokenService;
use Closure;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * @var TokenService
     */
    private $tokenService;

    /**
     * CheckToken constructor.
     * @param TokenService $tokenService
     */
    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $requestToken = (string)$request->header('TOKEN');
        $token = $this->tokenService->findActiveToken($requestToken);

        if (is_null($token)) {
            return new JsonResponse([
                'error' => 'FORBIDDEN'
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
