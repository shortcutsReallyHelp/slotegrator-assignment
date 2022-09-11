<?php declare(strict_types=1);

namespace Slotegrator\Business\User\DTO;

class CreateUserDTO
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
