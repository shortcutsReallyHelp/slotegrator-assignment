<?php declare(strict_types=1);

namespace Slotegrator\Business\Auth\TokenIssuer;

use Slotegrator\Business\Auth\Constants\MessagesInterface;
use Slotegrator\Business\Auth\Constants\TokenStructureInterface;
use Slotegrator\Business\Auth\DTO\SignInDTO;
use Slotegrator\Business\Auth\Exceptions\InvalidPasswordException;
use Slotegrator\Business\Auth\Exceptions\UserNotFoundException;
use Slotegrator\Business\Auth\UserReader\UserReaderInterface;
use Slotegrator\Business\JWT\JwtServiceInterface;
use Slotegrator\Business\Password\PasswordServiceInterface;
use Slotegrator\Business\User\Entities\User;
use Slotegrator\Business\User\UserServiceInterface;

class TokenIssuer implements TokenIssuerInterface
{
    public function __construct(
        private JwtServiceInterface $jwtService,
        private UserServiceInterface $userService,
        private PasswordServiceInterface $passwordService,
        private int $tokenLifeTimeInSeconds
    ) {
    }

    /**
     * @param SignInDTO $loginDTO
     * @return string
     */
    public function login(SignInDTO $loginDTO): string
    {
        $user = $this->userService->findByEmail($loginDTO->getEmail());

        if (!$user) {
            throw new UserNotFoundException(MessagesInterface::USER_NOT_FOUND);
        }

        if (!$this->passwordService->verify($loginDTO->getPassword(), $user->getPassword())) {
            throw new InvalidPasswordException(MessagesInterface::INVALID_PASSWORD);
        }

        return $this->jwtService->encode($this->getTokenPayload($user));
    }

    /**
     * @param User $user
     * @return array
     */
    protected function getTokenPayload(User $user): array
    {
        return [
            TokenStructureInterface::USER_EMAIL => $user->getEmail(),
            TokenStructureInterface::EXPIRES_IN => time() + $this->tokenLifeTimeInSeconds,
        ];
    }
}
