<?php declare(strict_types=1);

namespace Slotegrator\Business\User\UserCreator;

use Slotegrator\Business\User\DTO\CreateUserDTO;
use Slotegrator\Business\User\Entities\User;

interface UserCreatorInterface
{
    /**
     * @param CreateUserDTO $createUserDTO
     * @return User
     */
    public function create(CreateUserDTO $createUserDTO): User;
}
