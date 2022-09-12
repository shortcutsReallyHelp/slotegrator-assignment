<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle;

interface RaffleServiceInterface
{
    public function getRandomGift(): Raffle;
}
