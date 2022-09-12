<?php declare(strict_types=1);

namespace Slotegrator\Application\SignIn\DTO;

class SignInResult
{
    public function __construct(private bool $isSuccess, private string $message, private ?string $token){}

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }


}
