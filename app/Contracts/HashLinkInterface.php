<?php
declare(strict_types=1);

namespace App\Contracts;

interface HashLinkInterface
{
    public function hash(string $url): string;
}
