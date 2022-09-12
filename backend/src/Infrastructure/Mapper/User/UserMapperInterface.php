<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Mapper\User;

use Slotegrator\Business\User\Entities\User;
use Slotegrator\Infrastructure\Entities\User as InfrastructureUser;

interface UserMapperInterface
{
    public function map(User $user): InfrastructureUser;
    public function mapToDomain(InfrastructureUser $user): User;

}
