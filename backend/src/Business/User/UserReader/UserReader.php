<?php declare(strict_types=1);

namespace Slotegrator\Business\User\UserReader;

use Slotegrator\Business\User\Entities\User;
use Slotegrator\Business\User\UserRepositoryInterface;

class UserReader implements UserReaderInterface
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }
}
