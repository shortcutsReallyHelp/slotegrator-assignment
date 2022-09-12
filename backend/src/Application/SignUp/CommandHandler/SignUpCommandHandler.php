<?php declare(strict_types=1);

namespace Slotegrator\Application\SignUp\CommandHandler;

use Slotegrator\Application\SignUp\Constants\MessagesInterface;
use Slotegrator\Application\SignUp\Command\SignUpCommand;
use Slotegrator\Application\SignUp\DTO\SignUpResult;
use Slotegrator\Business\Common\Exceptions\BusinessException;
use Slotegrator\Business\I18n\I18nInterface;
use Slotegrator\Business\User\DTO\CreateUserDTO;
use Slotegrator\Business\User\UserServiceInterface;

class SignUpCommandHandler implements SignUpCommandHandlerInterface
{
    /**
     * @param UserServiceInterface $userService
     * @param I18nInterface $i18n
     */
    public function __construct(private UserServiceInterface $userService, private I18nInterface $i18n) {}

    public function handle(SignUpCommand $command): SignUpResult
    {
        try {
            $this->userService->create(new CreateUserDTO($command->getEmail(), $command->getPassword()));
        } catch (BusinessException $e) {
            return new SignUpResult(false, $e->getMessage());
        }

        return new SignUpResult(true, $this->i18n->translate(MessagesInterface::SUCCESS));
    }

}
