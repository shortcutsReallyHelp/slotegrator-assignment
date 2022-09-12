<?php declare(strict_types=1);

namespace Slotegrator\Application\SignIn\CommandHandler;

use Slotegrator\Application\SignIn\Constants\MessagesInterface;
use Slotegrator\Application\SignIn\Command\SignInCommand;
use Slotegrator\Application\SignIn\DTO\SignInResult;
use Slotegrator\Business\Auth\AuthServiceInterface;
use Slotegrator\Business\Auth\DTO\SignInDTO;
use Slotegrator\Business\Common\Exceptions\BusinessException;
use Slotegrator\Business\I18n\I18nInterface;

class SignInCommandHandler implements SignInCommandHandlerInterface
{
    /**
     * @param AuthServiceInterface $authService
     * @param I18nInterface $i18n
     */
    public function __construct(private AuthServiceInterface $authService, private I18nInterface $i18n) {}

    public function handle(SignInCommand $command): SignInResult
    {
        try {
            $token = $this->authService->login(new SignInDTO($command->getLogin(), $command->getPassword()));
        } catch (BusinessException $e) {
            return new SignInResult(false, $e->getMessage(), null);
        }

        return new SignInResult(true, $this->i18n->translate(MessagesInterface::SUCCESS), $token);
    }

}
