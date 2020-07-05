<?php
declare(strict_types=1);

namespace App\Services\TokenGenerator;

use App\Contracts\TokenGeneratorInterface;

class TokenGenerator implements TokenGeneratorInterface
{

    public function generate(): string
    {
        return md5(uniqid());
    }
}
