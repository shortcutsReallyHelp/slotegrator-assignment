<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'gift_transactions')]
class GiftTransaction
{
    use TimestampTrait;

    #[Column(type: 'integer'), Id, GeneratedValue]
    private int $id;

    #[Column(name: 'user_id', type: 'integer')]
    private int $userId;

    #[Column(name: 'gift_id', type: 'integer')]
    private int $giftId;

    #[Column(type: 'integer')]
    private int $amount;

    #[Column(name: 'gift_balance', type: 'integer')]
    private int $giftBalance;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return GiftTransaction
     */
    public function setId(int $id): GiftTransaction
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return GiftTransaction
     */
    public function setUserId(int $userId): GiftTransaction
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getGiftId(): int
    {
        return $this->giftId;
    }

    /**
     * @param int $giftId
     * @return GiftTransaction
     */
    public function setGiftId(int $giftId): GiftTransaction
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
     * @return GiftTransaction
     */
    public function setAmount(int $amount): GiftTransaction
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int
     */
    public function getGiftBalance(): int
    {
        return $this->giftBalance;
    }

    /**
     * @param int $giftBalance
     * @return GiftTransaction
     */
    public function setGiftBalance(int $giftBalance): GiftTransaction
    {
        $this->giftBalance = $giftBalance;
        return $this;
    }
}
