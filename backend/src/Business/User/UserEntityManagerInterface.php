<?php declare(strict_types=1);

namespace Slotegrator\Business\User;

use Slotegrator\Business\User\Entities\User;

interface UserEntityManagerInterface
{
    /**
     * @param User $user
     * @return void
     */
    public function create(User $user): void;
}
