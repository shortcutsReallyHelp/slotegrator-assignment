<?php declare(strict_types=1);

namespace Slotegrator\Business\User\UserCreator;

use Slotegrator\Business\Password\PasswordServiceInterface;
use Slotegrator\Business\User\DTO\CreateUserDTO;
use Slotegrator\Business\Common\Exceptions\BusinessException;
use Slotegrator\Business\I18n\I18nInterface;
use Slotegrator\Business\User\Constants\MessagesInterface;
use Slotegrator\Business\User\Entities\User;
use Slotegrator\Business\User\UserEntityManagerInterface;
use Slotegrator\Business\User\UserReader\UserReaderInterface;

class UserCreator implements UserCreatorInterface
{
    public function __construct(
        private UserReaderInterface $userReader,
        private UserEntityManagerInterface $userEntityManager,
        private I18nInterface $i18n,
        private PasswordServiceInterface $passwordService
    ) {}

    /**
     * @param CreateUserDTO $createUserDTO
     * @return User
     * @throws BusinessException
     */
    public function create(CreateUserDTO $createUserDTO): User
    {
        $userDTO = $this->userReader->findByEmail($createUserDTO->getEmail());

        if ($userDTO) {
            throw new BusinessException($this->i18n->translate(MessagesInterface::USER_ALREADY_EXISTS));
        }
        $this->userEntityManager->create(
            (new User())
                ->setEmail($createUserDTO->getEmail())
                ->setPassword($this->passwordService->hash($createUserDTO->getPassword()))
        );

        return $this->userReader->findByEmail($createUserDTO->getEmail());
    }
}
