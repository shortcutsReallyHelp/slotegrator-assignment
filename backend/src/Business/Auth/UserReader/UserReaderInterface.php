<?php declare(strict_types=1);

namespace Slotegrator\Business\Auth\UserReader;

use Slotegrator\Business\User\Entities\User;

interface UserReaderInterface
{
    /**
     * @param string $token
     * @return User|null
     */
    public function getUserByToken(string $token): ?User;
}
