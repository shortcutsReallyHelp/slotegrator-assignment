<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle;

use Slotegrator\Business\Raffle\Entities\Raffle;

interface RaffleEntityManagerInterface
{
    public function createRaffle(Raffle $raffle): Raffle;
}
