<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift\DTO;

class WithdrawGift
{
    public function __construct(private int $giftId, private int $amount = 1){}

    /**
     * @return int
     */
    public function getGiftId(): int
    {
        return $this->giftId;
    }

    /**
     * @param int $giftId
     * @return WithdrawGift
     */
    public function setGiftId(int $giftId): WithdrawGift
    {
        $this->giftId = $giftId;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return WithdrawGift
     */
    public function setAmount(int $amount): WithdrawGift
    {
        $this->amount = $amount;
        return $this;
    }
}
