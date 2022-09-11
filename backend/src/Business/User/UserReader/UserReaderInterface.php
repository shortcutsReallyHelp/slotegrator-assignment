<?php declare(strict_types=1);

namespace Slotegrator\Business\User\UserReader;

use Slotegrator\Business\User\Entities\User;

interface UserReaderInterface
{
    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}
