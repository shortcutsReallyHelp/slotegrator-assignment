<?php declare(strict_types=1);

namespace Slotegrator\Http\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class SignUpRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    public string $password;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    #[Assert\EqualTo(propertyPath: 'password')]
    public string $passwordConfirmation;
}
