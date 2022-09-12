<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Mapper\Raffle;

use Slotegrator\Business\Raffle\Entities\Raffle;
use Slotegrator\Infrastructure\Entities\Raffle as InfrastructureRaffle;

interface RaffleMapperInterface
{
    public function map(Raffle $raffle): InfrastructureRaffle;
    public function mapToDomain(InfrastructureRaffle $raffle): Raffle;
}
