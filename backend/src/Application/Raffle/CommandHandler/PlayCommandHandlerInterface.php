<?php declare(strict_types=1);

namespace Slotegrator\Application\Raffle\CommandHandler;

use Slotegrator\Application\Raffle\Command\PlayCommand;
use Slotegrator\Application\Raffle\DTO\PlayResult;

interface PlayCommandHandlerInterface
{
    public function handle(PlayCommand $command): PlayResult;
}
