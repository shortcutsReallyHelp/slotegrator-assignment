<?php declare(strict_types=1);

namespace Slotegrator\Application\Raffle\DTO;

use Slotegrator\Business\Raffle\Entities\Raffle;

class PlayResult
{
    public function __construct(protected Raffle $raffle){}

    /**
     * @return Raffle
     */
    public function getRaffle(): Raffle
    {
        return $this->raffle;
    }
}
