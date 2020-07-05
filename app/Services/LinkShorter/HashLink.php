<?php
declare(strict_types=1);

namespace App\Services\LinkShorter;

use App\Contracts\HashLinkInterface;

class HashLink implements HashLinkInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function hash(string $url): string
    {
        return md5($url);
    }
}
