<?php declare(strict_types=1);

namespace Slotegrator\Business\User;

use Slotegrator\Business\User\Entities\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}
