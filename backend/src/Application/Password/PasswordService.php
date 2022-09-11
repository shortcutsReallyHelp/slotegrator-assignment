<?php declare(strict_types=1);

namespace Slotegrator\Application\Password;

use Slotegrator\Business\Password\PasswordServiceInterface;

class PasswordService implements PasswordServiceInterface
{
    public function __construct(protected string $secret) {}

    /**
     * @param string $password
     * @return string
     */
    public function hash(string $password): string
    {
        return password_hash($this->secret . $password, PASSWORD_DEFAULT);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function verify(string $password, string $hash): bool
    {
        return password_verify($this->secret . $password, $hash);
    }
}
