<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle;

use Slotegrator\Business\Raffle\Entities\Raffle;

interface RaffleServiceInterface
{
    public function play(int $userId): Raffle;
}
