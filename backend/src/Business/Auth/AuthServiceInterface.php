<?php declare(strict_types=1);

namespace Slotegrator\Business\Auth;

use Slotegrator\Business\Auth\DTO\SignInDTO;
use Slotegrator\Business\User\Entities\User;

interface AuthServiceInterface
{
    /**
     * @param SignInDTO $loginDTO
     * @return string
     */
    public function login(SignInDTO $loginDTO): string;

    /**
     * @param string $token
     * @return User|null
     */
    public function getUserByToken(string $token): ?User;
}
