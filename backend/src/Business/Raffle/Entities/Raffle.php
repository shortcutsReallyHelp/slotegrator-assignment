<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\Entities;


class Raffle
{
    public const TYPE_MONEY = 'money';
    public const TYPE_GIFT = 'gift';
    public const TYPE_BONUS = 'bonus';

    private ?int $id = null;
    private ?int $userId = null;
    private ?string $type = null;
    private ?int $giftId = null;
    private ?string $giftName = null;
    private ?int $giftAmount = null;
    private ?int $giftTransactionId = null;
    private ?int $moneyAmount = null;
    private ?int $moneyTransactionId = null;
    private ?int $bonusAmount = null;
    private ?int $bonusTransactionId = null;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Raffle
     */
    public function setId(?int $id): Raffle
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     * @return Raffle
     */
    public function setUserId(?int $userId): Raffle
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return Raffle
     */
    public function setType(?string $type): Raffle
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGiftId(): ?int
    {
        return $this->giftId;
    }

    /**
     * @param int|null $giftId
     * @return Raffle
     */
    public function setGiftId(?int $giftId): Raffle
    {
        $this->giftId = $giftId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGiftName(): ?string
    {
        return $this->giftName;
    }

    /**
     * @param string|null $giftName
     * @return Raffle
     */
    public function setGiftName(?string $giftName): Raffle
    {
        $this->giftName = $giftName;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGiftAmount(): ?int
    {
        return $this->giftAmount;
    }

    /**
     * @param int|null $giftAmount
     * @return Raffle
     */
    public function setGiftAmount(?int $giftAmount): Raffle
    {
        $this->giftAmount = $giftAmount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGiftTransactionId(): ?int
    {
        return $this->giftTransactionId;
    }

    /**
     * @param int|null $giftTransactionId
     * @return Raffle
     */
    public function setGiftTransactionId(?int $giftTransactionId): Raffle
    {
        $this->giftTransactionId = $giftTransactionId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMoneyAmount(): ?int
    {
        return $this->moneyAmount;
    }

    /**
     * @param int|null $moneyAmount
     * @return Raffle
     */
    public function setMoneyAmount(?int $moneyAmount): Raffle
    {
        $this->moneyAmount = $moneyAmount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMoneyTransactionId(): ?int
    {
        return $this->moneyTransactionId;
    }

    /**
     * @param int|null $moneyTransactionId
     * @return Raffle
     */
    public function setMoneyTransactionId(?int $moneyTransactionId): Raffle
    {
        $this->moneyTransactionId = $moneyTransactionId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBonusAmount(): ?int
    {
        return $this->bonusAmount;
    }

    /**
     * @param int|null $bonusAmount
     * @return Raffle
     */
    public function setBonusAmount(?int $bonusAmount): Raffle
    {
        $this->bonusAmount = $bonusAmount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBonusTransactionId(): ?int
    {
        return $this->bonusTransactionId;
    }

    /**
     * @param int|null $bonusTransactionId
     * @return Raffle
     */
    public function setBonusTransactionId(?int $bonusTransactionId): Raffle
    {
        $this->bonusTransactionId = $bonusTransactionId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Raffle
     */
    public function setCreatedAt(\DateTime $createdAt): Raffle
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Raffle
     */
    public function setUpdatedAt(\DateTime $updatedAt): Raffle
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
