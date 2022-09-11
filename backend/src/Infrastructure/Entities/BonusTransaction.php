<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'bonus_transactions')]
class BonusTransaction
{
    use TimestampTrait;

    #[Column(type: 'integer'), Id, GeneratedValue]
    private int $id;

    #[Column(name: 'user_id', type: 'integer')]
    private int $userId;

    #[Column(name: 'amount', type: 'integer')]
    private int $amount;

    #[Column(name: 'balance', type: 'integer')]
    private int $balance;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return BonusTransaction
     */
    public function setId(int $id): BonusTransaction
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
     * @return BonusTransaction
     */
    public function setUserId(int $userId): BonusTransaction
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
     * @return BonusTransaction
     */
    public function setAmount(int $amount): BonusTransaction
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
     * @return BonusTransaction
     */
    public function setBalance(int $balance): BonusTransaction
    {
        $this->balance = $balance;
        return $this;
    }
}
