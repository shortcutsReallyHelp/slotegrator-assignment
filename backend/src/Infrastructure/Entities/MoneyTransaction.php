<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;


#[Entity, Table(name: 'money_transactions')]
class MoneyTransaction
{
    use TimestampTrait;

    #[Column(type: 'integer'), Id, GeneratedValue]
    private int $id;

    #[Column(name: 'user_id', type: 'integer', nullable: true)]
    private ?int $userId;

    #[Column(name: 'amount', type: 'integer')]
    private int $amount;

    #[Column(name: 'balance', type: 'integer')]
    private int $balance;

    #[Column(name: 'is_withdrawal_processed', type: 'boolean')]
    private bool $isWithdrawalProcessed;

    /**
     * @return bool
     */
    public function isWithdrawalProcessed(): bool
    {
        return $this->isWithdrawalProcessed;
    }

    /**
     * @param bool $isWithdrawalProcessed
     * @return MoneyTransaction
     */
    public function setIsWithdrawalProcessed(bool $isWithdrawalProcessed): MoneyTransaction
    {
        $this->isWithdrawalProcessed = $isWithdrawalProcessed;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return MoneyTransaction
     */
    public function setId(int $id): MoneyTransaction
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
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return MoneyTransaction
     */
    public function setAmount(int $amount): MoneyTransaction
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     * @return MoneyTransaction
     */
    public function setBalance(int $balance): MoneyTransaction
    {
        $this->balance = $balance;
        return $this;
    }
}
