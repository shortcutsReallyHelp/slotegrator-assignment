<?php declare(strict_types=1);

namespace Slotegrator\Business\BonusTransaction\Entities;

class BonusTransaction
{
    public function __construct(
        private ?int $id = null,
        private ?int $userId = null,
        private ?int $amount = null,
        private ?int $balance = null,
        private ?\DateTime $createdAt = null,
        private ?\DateTime $updatedAt = null,
    ){}

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return BonusTransaction
     */
    public function setId(?int $id): BonusTransaction
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
     * @return BonusTransaction
     */
    public function setUserId(?int $userId): BonusTransaction
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @param int|null $amount
     * @return BonusTransaction
     */
    public function setAmount(?int $amount): BonusTransaction
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBalance(): ?int
    {
        return $this->balance;
    }

    /**
     * @param int|null $balance
     * @return BonusTransaction
     */
    public function setBalance(?int $balance): BonusTransaction
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     * @return BonusTransaction
     */
    public function setCreatedAt(?\DateTime $createdAt): BonusTransaction
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     * @return BonusTransaction
     */
    public function setUpdatedAt(?\DateTime $updatedAt): BonusTransaction
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
