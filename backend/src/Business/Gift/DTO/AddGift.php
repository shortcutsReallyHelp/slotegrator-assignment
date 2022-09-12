<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift\DTO;

class AddGift
{
    public function __construct(private int $giftId, private ?int $userId = null, private int $amount = 1){}

    /**
     * @return int
     */
    public function getGiftId(): int
    {
        return $this->giftId;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
