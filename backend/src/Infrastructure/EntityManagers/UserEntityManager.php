<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\EntityManagers;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Slotegrator\Business\User\Entities\User;
use Slotegrator\Business\User\UserEntityManagerInterface;
use Slotegrator\Infrastructure\Mapper\User\UserMapperInterface;

class UserEntityManager implements UserEntityManagerInterface
{

    public function __construct(private UserMapperInterface $userMapper, private EntityManagerInterface $entityManager) {}

    public function create(User $user): void
    {
        $userInfrastructure = $this->userMapper->map($user);
        $userInfrastructure->setCreatedAt(new \DateTime());
        $userInfrastructure->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($userInfrastructure);

        $this->entityManager->flush();
    }
}
