<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;


#[Entity, Table(name: 'settings')]
class Setting
{
    use TimestampTrait;

    #[Column(type: 'integer'), Id, GeneratedValue]
    private int $id;

    #[Column(type: 'string', length: 255)]
    private string $key;

    #[Column(type: 'string', length: 255)]
    private string $type;

    #[Column(type: 'integer', nullable: true)]
    private ?int $valueInt;

    #[Column(type: 'integer', nullable: true)]
    private ?int $valueRangeIntMin;

    #[Column(type: 'integer', nullable: true)]
    private ?int $valueRangeIntMax;

    #[Column(type: 'string', length: 255, nullable: true)]
    private ?string $valueString;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Setting
     */
    public function setId(int $id): Setting
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return Setting
     */
    public function setKey(string $key): Setting
    {
        $this->key = $key;
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
     * @return Setting
     */
    public function setType(string $type): Setting
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getValueInt(): ?int
    {
        return $this->valueInt;
    }

    /**
     * @param int|null $valueInt
     * @return Setting
     */
    public function setValueInt(?int $valueInt): Setting
    {
        $this->valueInt = $valueInt;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getValueRangeIntMin(): ?int
    {
        return $this->valueRangeIntMin;
    }

    /**
     * @param int|null $valueRangeIntMin
     * @return Setting
     */
    public function setValueRangeIntMin(?int $valueRangeIntMin): Setting
    {
        $this->valueRangeIntMin = $valueRangeIntMin;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getValueRangeIntMax(): ?int
    {
        return $this->valueRangeIntMax;
    }

    /**
     * @param int|null $valueRangeIntMax
     * @return Setting
     */
    public function setValueRangeIntMax(?int $valueRangeIntMax): Setting
    {
        $this->valueRangeIntMax = $valueRangeIntMax;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getValueString(): ?string
    {
        return $this->valueString;
    }

    /**
     * @param string|null $valueString
     * @return Setting
     */
    public function setValueString(?string $valueString): Setting
    {
        $this->valueString = $valueString;
        return $this;
    }
}
