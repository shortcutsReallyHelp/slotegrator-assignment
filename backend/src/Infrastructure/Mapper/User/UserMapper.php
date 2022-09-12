<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Mapper\User;

use Slotegrator\Business\User\Entities\User;
use Slotegrator\Infrastructure\Entities\User as InfrastructureUser;

class UserMapper implements UserMapperInterface
{

    public function map(User $user): InfrastructureUser
    {
        $infrastructureUser = new InfrastructureUser();

        if ($user->getId()) {
            $infrastructureUser->setId($user->getId());
        }

        $infrastructureUser->setEmail($user->getEmail());
        $infrastructureUser->setPassword($user->getPassword());

        if ($user->getCreatedAt()) {
            $infrastructureUser->setCreatedAt(\DateTime::createFromImmutable($user->getCreatedAt()));
        }
        if ($user->getUpdatedAt()) {
            $infrastructureUser->setUpdatedAt(\DateTime::createFromImmutable($user->getUpdatedAt()));
        }

        return $infrastructureUser;
    }

    public function mapToDomain(InfrastructureUser $user): User
    {
        return new User(
            $user->getId(),
            $user->getEmail(),
            $user->getPassword(),
            \DateTimeImmutable::createFromMutable($user->getCreatedAt()),
            \DateTimeImmutable::createFromMutable($user->getUpdatedAt())
        );
    }
}
