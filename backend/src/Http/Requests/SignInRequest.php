<?php declare(strict_types=1);

namespace Slotegrator\Http\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class SignInRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    public string $password;
}
