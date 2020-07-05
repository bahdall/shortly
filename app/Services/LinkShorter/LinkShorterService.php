<?php
declare(strict_types=1);

namespace App\Services\LinkShorter;

use App\Contracts\HashLinkInterface;
use App\Models\Link;
use App\Services\TokenGenerator\TokenService;
use InvalidArgumentException;
use Psr\SimpleCache\CacheInterface;
use Throwable;

class LinkShorterService
{
    /**
     * @var HashLinkInterface
     */
    private $hashLink;
    /**
     * @var TokenService
     */
    private $tokenService;
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * LinkShorterService constructor.
     * @param HashLinkInterface $hashLink
     * @param TokenService $tokenService
     * @param CacheInterface $cache
     */
    public function __construct(HashLinkInterface $hashLink, TokenService $tokenService, CacheInterface $cache)
    {
        $this->hashLink = $hashLink;
        $this->tokenService = $tokenService;
        $this->cache = $cache;
    }

    /**
     * @param string $url
     * @param string $token
     * @return Link
     * @throws Throwable
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function createLink(string $url, string $token): Link
    {
        $link = $this->findByUrl($url);

        if (is_null($link)) {
            $tokenModel = $this->tokenService->findActiveToken($token);

            if (is_null($tokenModel)) {
                throw new InvalidArgumentException('Invalid token');
            }

            $link = new Link();
            $link->url = $url;
            $link->hash = $this->hashLink->hash($url);
            $link->token_id = $tokenModel->id;
            $link->saveOrFail();
        }

        return $link;
    }

    /**
     * @param string $url
     * @return Link|null
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function findByUrl(string $url): ?Link
    {
        $cacheKey = $this->getCacheKey($url, 'findByUrl');

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        /** @var Link $link */
        $link = Link::where('url', $url)->first();
        $this->cache->set($cacheKey, $link, 60);

        return $link;
    }

    /**
     * @param string $hash
     * @return Link|null
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function findByHash(string $hash): ?Link
    {
        $cacheKey = $this->getCacheKey($hash, 'findByHash');

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        /** @var Link $link */
        $link = Link::where('hash', $hash)->first();
        $this->cache->set($cacheKey, $link, 60);

        return $link;
    }

    /**
     * @param string $param
     * @param string $prefix
     * @return string
     */
    private function getCacheKey(string $param, string $prefix)
    {
        return sha1('LinkShorterService:'.$prefix.':'.$param);
    }
}
