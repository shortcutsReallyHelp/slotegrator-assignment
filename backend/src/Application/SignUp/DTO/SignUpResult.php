<?php declare(strict_types=1);

namespace Slotegrator\Application\SignUp\DTO;

class SignUpResult
{
    public function __construct(private bool $isSuccess, private string $message){}

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
}
