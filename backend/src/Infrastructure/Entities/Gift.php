<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'gifts')]
class Gift
{
    use TimestampTrait;

    #[Column(type: 'integer'), Id, GeneratedValue]
    private int $id;

    #[Column(type: 'string', length: 255)]
    private string $name;

    #[Column(type: 'integer')]
    private int $balance;

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     * @return Gift
     */
    public function setBalance(int $balance): Gift
    {
        $this->balance = $balance;
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
     * @return Gift
     */
    public function setId(int $id): Gift
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Gift
     */
    public function setName(string $name): Gift
    {
        $this->name = $name;
        return $this;
    }
}
