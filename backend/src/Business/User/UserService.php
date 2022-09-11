<?php declare(strict_types=1);

namespace Slotegrator\Business\User;

use Slotegrator\Business\User\DTO\CreateUserDTO;
use Slotegrator\Business\User\Entities\User;
use Slotegrator\Business\User\UserCreator\UserCreatorInterface;
use Slotegrator\Business\User\UserReader\UserReaderInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserCreatorInterface $userCreator,
        private UserReaderInterface $userReader
    ) {}

    /**
     * @param CreateUserDTO $createUserDTO
     * @return User
     */
    public function create(CreateUserDTO $createUserDTO): User
    {
        return $this->userCreator->create($createUserDTO);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->userReader->findByEmail($email);
    }
}
