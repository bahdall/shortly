<?php
declare(strict_types=1);

namespace App\Services\TokenGenerator;

use App\Contracts\TokenGeneratorInterface;
use App\Models\Token;

class TokenService
{
    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;

    /**
     * TokenService constructor.
     * @param TokenGeneratorInterface $tokenGenerator
     */
    public function __construct(TokenGeneratorInterface $tokenGenerator)
    {
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * @return Token
     * @throws \Throwable
     */
    public function createToken(): Token
    {
        $token = new Token();
        $token->is_active = true;
        $token->token = $this->tokenGenerator->generate();
        $token->saveOrFail();

        return $token;
    }

    /**
     * @param string $token
     * @return Token|null
     */
    public function findActiveToken(string $token): ?Token
    {
        /** @var Token $token */
        $token = Token::where('token', $token)->where('is_active', true)->first();
        return $token;
    }

}
