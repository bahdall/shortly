<?php
declare(strict_types=1);

namespace App\Contracts;

interface TokenGeneratorInterface
{
    public function generate(): string;
}
