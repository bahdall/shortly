<?php
declare(strict_types=1);

namespace App\Services\LinkShorter;

use App\Contracts\HashLinkInterface;
use App\Models\Link;
use App\Services\TokenGenerator\TokenService;

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
     * LinkShorterService constructor.
     * @param HashLinkInterface $hashLink
     * @param TokenService $tokenService
     */
    public function __construct(HashLinkInterface $hashLink, TokenService $tokenService)
    {
        $this->hashLink = $hashLink;
        $this->tokenService = $tokenService;
    }

    /**
     * @param string $url
     * @param string $token
     * @return Link
     * @throws \Throwable
     */
    public function createLink(string $url, string $token): Link
    {
        $link = $this->findByUrl($url);

        if (is_null($link)) {
            $tokenModel = $this->tokenService->findActiveToken($token);

            if (is_null($tokenModel)) {
                throw new \InvalidArgumentException('Invalid token');
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
     */
    public function findByUrl(string $url): ?Link
    {
        /** @var Link $link */
        $link = Link::where('url', $url)->first();
        return $link;
    }

    /**
     * @param string $hash
     * @return Link|null
     */
    public function findByHash(string $hash): ?Link
    {
        /** @var Link $link */
        $link = Link::where('hash', $hash)->first();
        return $link;
    }
}
