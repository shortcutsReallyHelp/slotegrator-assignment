<?php declare(strict_types=1);

namespace Slotegrator\Business\Auth\TokenIssuer;

use Slotegrator\Business\Auth\DTO\SignInDTO;

interface TokenIssuerInterface
{
    /**
     * @param SignInDTO $loginDTO
     * @return string
     */
    public function login(SignInDTO $loginDTO): string;
}
