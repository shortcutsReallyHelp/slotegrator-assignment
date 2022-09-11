<?php declare(strict_types=1);

namespace Slotegrator\Business\Auth\UserReader;

use Slotegrator\Business\Auth\Constants\TokenStructureInterface;
use Slotegrator\Business\JWT\JwtServiceInterface;
use Slotegrator\Business\User\Entities\User;
use Slotegrator\Business\User\UserServiceInterface;

class UserReader implements UserReaderInterface
{
    /**
     * @param UserServiceInterface $userService
     * @param JwtServiceInterface $jwtService
     */
    public function __construct(
        private UserServiceInterface $userService,
        private JwtServiceInterface $jwtService,
    ) {}

    /**
     * @param string $token
     * @return User|null
     */
    public function getUserByToken(string $token): ?User
    {
        $payload = $this->jwtService->decode($token);
        $email = $payload[TokenStructureInterface::USER_EMAIL] ?? null;

        if (!$email) {
            return null;
        }

        return $this->userService->findByEmail($email);
    }

}
