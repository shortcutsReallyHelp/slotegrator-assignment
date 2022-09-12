<?php declare(strict_types=1);

namespace Slotegrator\Application\SignUp\CommandHandler;

use Slotegrator\Application\SignUp\Command\SignUpCommand;
use Slotegrator\Application\SignUp\DTO\SignUpResult;

interface SignUpCommandHandlerInterface
{
    public function handle(SignUpCommand $command): SignUpResult;
}
