<?php
declare(strict_types=1);

namespace App\Contracts;

interface HashLinkInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function hash(string $url): string;
}
