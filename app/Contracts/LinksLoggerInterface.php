<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Models\Link;

interface LinksLoggerInterface
{
    /**
     * @param Link $link
     * @param string $userAgent
     * @param string $userIp
     * @param string $referrer
     * @return mixed
     */
    public function log(Link $link, ?string $userAgent, ?string $userIp, ?string $referrer);
}
