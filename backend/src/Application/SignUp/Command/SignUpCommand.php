<?php declare(strict_types=1);

namespace Slotegrator\Application\SignUp\Command;

class SignUpCommand
{
    public function __construct(private string $email, private string $password) {}

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
