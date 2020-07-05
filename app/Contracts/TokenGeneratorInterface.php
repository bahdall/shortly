<?php
declare(strict_types=1);

namespace App\Contracts;

interface TokenGeneratorInterface
{
    /**
     * @return string
     */
    public function generate(): string;
}
