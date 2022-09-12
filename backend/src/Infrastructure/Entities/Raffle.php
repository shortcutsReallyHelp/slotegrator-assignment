<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'raffles')]
class Raffle
{
    use TimestampTrait;

    #[Column(type: 'integer'), Id, GeneratedValue]
    private int $id;

    #[Column(name: 'user_id', type: 'integer')]
    private int $userId;

    #[Column(type: 'string', length: 255)]
    private string $type;

    #[Column(name: 'gift_id', type: 'integer', nullable: true)]
    private ?int $giftId;

    #[Column(name: 'gift_name', type: 'string', length: 255, nullable: true)]
    private ?string $giftName;

    #[Column(name: 'gift_transaction_id', type: 'integer', nullable: true)]
    private ?int $giftTransactionId;

    #[Column(name: 'gift_amount', type: 'integer', nullable: true)]
    private ?int $giftAmount;

    #[Column(name: 'money_amount', type: 'integer', nullable: true)]
    private ?int $moneyAmount;

    #[Column(name: 'money_transaction_id', type: 'integer', nullable: true)]
    private ?int $moneyTransactionId;

    #[Column(name: 'bonus_amount', type: 'integer', nullable: true)]
    private ?int $bonusAmount;

    #[Column(name: 'bonus_transaction_id', type: 'integer', nullable: true)]
    private ?int $bonusTransactionId;

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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Raffle
     */
    public function setId(int $id): Raffle
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
     * @return Raffle
     */
    public function setUserId(int $userId): Raffle
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Raffle
     */
    public function setType(string $type): Raffle
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
}
