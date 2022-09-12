<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\ProbabilityGenerator;

interface ProbabilityGeneratorInterface
{

    public function generate(): array;
}
