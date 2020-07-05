<?php
declare(strict_types=1);

namespace App\Services\TokenGenerator;

use App\Contracts\TokenGeneratorInterface;
use App\Models\Token;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;
use Throwable;

class TokenService
{
    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * TokenService constructor.
     * @param TokenGeneratorInterface $tokenGenerator
     * @param CacheInterface $cache
     */
    public function __construct(TokenGeneratorInterface $tokenGenerator, CacheInterface $cache)
    {
        $this->tokenGenerator = $tokenGenerator;
        $this->cache = $cache;
    }

    /**
     * @return Token
     * @throws Throwable
     */
    public function createToken(): Token
    {
        $token = new Token();
        $token->is_active = true;
        $token->token = $this->tokenGenerator->generate();
        $token->saveOrFail();

        return $token;
    }

    /**
     * @param string $token
     * @return Token|null
     * @throws InvalidArgumentException
     */
    public function findActiveToken(string $token): ?Token
    {
        $cacheKey = $this->getCacheKey($token);

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        /** @var Token $token */
        $token = Token::where('token', $token)->where('is_active', true)->first();
        $this->cache->set($cacheKey, $token, 60);

        return $token;
    }

    /**
     * @param string $token
     * @return string
     */
    private function getCacheKey(string $token): string
    {
        return sha1('tokenService:'.$token);
    }
}
