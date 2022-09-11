<?php declare(strict_types=1);

namespace Slotegrator\Business\User;

use Slotegrator\Business\User\DTO\CreateUserDTO;
use Slotegrator\Business\User\Entities\User;

interface UserServiceInterface
{
    /**
     * @param CreateUserDTO $createUserDTO
     * @return User
     */
    public function create(CreateUserDTO $createUserDTO): User;

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}
