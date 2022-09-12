<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\Randomiser;

interface RandomiserInterface
{
    public function getRandomNumber(int $min, int $max): int;
}
