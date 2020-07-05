<?php
declare(strict_types=1);

namespace App\Services\LinksLogger;

use App\Contracts\LinksLoggerInterface;
use App\Models\Link;
use App\Models\Log;
use App\Services\RequestGetter\RequestGetter;
use App\Services\RequestGetter\UserAgentRepository;
use App\Services\RequestGetter\UserIpRepository;
use App\Services\RequestGetter\UserReferrerRepository;
use Psr\SimpleCache\CacheInterface;

class LinksLogger implements LinksLoggerInterface
{
    /**
     * @var RequestGetter
     */
    private $requestGetter;
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * LinksLogger constructor.
     * @param RequestGetter $requestGetter
     * @param CacheInterface $cache
     */
    public function __construct(RequestGetter $requestGetter, CacheInterface $cache)
    {
        $this->requestGetter = $requestGetter;
        $this->cache = $cache;
    }

    /**
     * @param Link $link
     * @param string $userAgent
     * @param string $userIp
     * @param string $referrer
     * @return mixed|void
     */
    public function log(Link $link, ?string $userAgent, ?string $userIp, ?string $referrer): void
    {
        $log = new Log();
        $log->link_id = $link->id;
        $log->token_id = $link->token_id;
        $log->user_agent_id = !is_null($userAgent) ? $this->requestGetter->setRepository(new UserAgentRepository($this->cache))->getIdByValue($userAgent) : null;
        $log->user_ip_id = !is_null($userIp) ? $this->requestGetter->setRepository(new UserIpRepository($this->cache))->getIdByValue($userIp) : null;
        $log->referrer_id = !is_null($referrer) ? $this->requestGetter->setRepository(new UserReferrerRepository($this->cache))->getIdByValue($referrer) : null;
        $log->save();
    }
}
