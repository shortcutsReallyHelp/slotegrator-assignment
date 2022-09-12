<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\Randomiser;

class Randomiser implements RandomiserInterface
{
    public function getRandomNumber(int $min, int $max): int
    {
        return rand($min, $max);
    }
}
