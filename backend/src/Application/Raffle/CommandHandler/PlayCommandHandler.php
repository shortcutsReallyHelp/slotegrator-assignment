<?php declare(strict_types=1);

namespace Slotegrator\Application\Raffle\CommandHandler;

use Slotegrator\Application\Raffle\Command\PlayCommand;
use Slotegrator\Application\Raffle\DTO\PlayResult;
use Slotegrator\Business\Raffle\RaffleServiceInterface;

class PlayCommandHandler implements PlayCommandHandlerInterface
{
    public function __construct(protected RaffleServiceInterface $raffleService){}

    public function handle(PlayCommand $command): PlayResult
    {
        $raffle = $this->raffleService->play($command->getUserId());

        return new PlayResult($raffle);
    }
}
