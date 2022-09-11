<?php declare(strict_types=1);

namespace Slotegrator\Business\Password;

interface PasswordServiceInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function hash(string $password): string;

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function verify(string $password, string $hash): bool;
}
