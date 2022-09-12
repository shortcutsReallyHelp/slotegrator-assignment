<?php declare(strict_types=1);

namespace Slotegrator\Application\SignIn\CommandHandler;

use Slotegrator\Application\SignIn\Command\SignInCommand;
use Slotegrator\Application\SignIn\DTO\SignInResult;

interface SignInCommandHandlerInterface
{
    public function handle(SignInCommand $command): SignInResult;
}
