<?php declare(strict_types=1);

namespace Slotegrator\Business\Auth;

use Slotegrator\Business\Auth\DTO\SignInDTO;
use Slotegrator\Business\Auth\TokenIssuer\TokenIssuerInterface;
use Slotegrator\Business\Auth\UserReader\UserReaderInterface;
use Slotegrator\Business\User\Entities\User;

class AuthService implements AuthServiceInterface
{
    public function __construct(private TokenIssuerInterface $tokenIssuer, private UserReaderInterface $userReader){}

    public function login(SignInDTO $loginDTO): string
    {
        return $this->tokenIssuer->login($loginDTO);
    }

    public function getUserByToken(string $token): ?User
    {
        return $this->userReader->getUserByToken($token);
    }
}
