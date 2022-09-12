<?php declare(strict_types=1);

namespace Slotegrator\Business\MoneyTransaction\Entities;

class MoneyTransaction
{
    public function __construct(
        private ?int $id = null,
        private ?int $userId = null,
        private ?int $amount = null,
        private ?bool $isWithdrawalProcessed = null,
        private ?\DateTime $createdAt = null,
        private ?\DateTime $updatedAt = null,
    ) {}

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return MoneyTransaction
     */
    public function setId(?int $id): MoneyTransaction
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
     * @return MoneyTransaction
     */
    public function setUserId(?int $userId): MoneyTransaction
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
     * @return MoneyTransaction
     */
    public function setAmount(?int $amount): MoneyTransaction
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsWithdrawalProcessed(): ?bool
    {
        return $this->isWithdrawalProcessed;
    }

    /**
     * @param bool|null $isWithdrawalProcessed
     * @return MoneyTransaction
     */
    public function setIsWithdrawalProcessed(?bool $isWithdrawalProcessed): MoneyTransaction
    {
        $this->isWithdrawalProcessed = $isWithdrawalProcessed;
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
     * @return MoneyTransaction
     */
    public function setCreatedAt(?\DateTime $createdAt): MoneyTransaction
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
     * @return MoneyTransaction
     */
    public function setUpdatedAt(?\DateTime $updatedAt): MoneyTransaction
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
