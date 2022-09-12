<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Slotegrator\Business\User\UserRepositoryInterface;
use Slotegrator\Business\User\Entities\User as EntityUser;
use Slotegrator\Infrastructure\Entities\User;
use Slotegrator\Infrastructure\Mapper\User\UserMapperInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(protected EntityManagerInterface $entityManager, protected UserMapperInterface $userMapper) {}

    public function findByEmail(string $email): ?EntityUser
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        return $user ? $this->userMapper->mapToDomain($user) : null;
    }
}
