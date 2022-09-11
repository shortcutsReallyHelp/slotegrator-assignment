<?php declare(strict_types=1);

namespace Slotegrator\Business\User;

use Slotegrator\Business\User\Entities\User;

interface UserEntityManagerInterface
{
    /**
     * @param User $user
     * @return User
     */
    public function create(User $user): User;
}
