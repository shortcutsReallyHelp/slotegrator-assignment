<?php declare(strict_types=1);

namespace Slotegrator\Application\Raffle\Command;

class PlayCommand
{
    public function __construct(protected int $userId){}

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
