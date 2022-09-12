<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\ProbabilityGenerator;

use Slotegrator\Business\Raffle\Entities\Raffle;

interface RaffleProbabilityInterface
{
    public function play(int $userId): Raffle;
}
