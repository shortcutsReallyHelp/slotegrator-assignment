<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\Writer;

use Slotegrator\Business\Raffle\Entities\Raffle;
use Slotegrator\Business\Raffle\RaffleEntityManagerInterface;

class RaffleWriter implements RaffleWriterInterface
{
    public function __construct(protected RaffleEntityManagerInterface $raffleEntityManager){}

    public function createRaffle(Raffle $raffle): Raffle
    {
        return $this->raffleEntityManager->createRaffle($raffle);
    }

}
