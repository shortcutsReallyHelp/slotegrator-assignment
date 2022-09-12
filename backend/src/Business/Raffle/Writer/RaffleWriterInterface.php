<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\Writer;

use Slotegrator\Business\Raffle\Entities\Raffle;

interface RaffleWriterInterface
{
    public function createRaffle(Raffle $raffle): Raffle;
}
