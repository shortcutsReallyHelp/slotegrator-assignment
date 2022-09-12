<?php declare(strict_types=1);

namespace Slotegrator\Application\SignIn\Command;

class SignInCommand
{
    public function __construct(private string $login, private string $password) {}

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
