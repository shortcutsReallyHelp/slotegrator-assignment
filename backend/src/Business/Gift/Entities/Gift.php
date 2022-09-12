<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift\Entities;

class Gift
{
    public function __construct(private ?int $id = null, private ?string $name = null, private ?int $balance = null) {}

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Gift
     */
    public function setId(?int $id): Gift
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Gift
     */
    public function setName(?string $name): Gift
    {
        $this->name = $name;
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
     * @return Gift
     */
    public function setBalance(?int $balance): Gift
    {
        $this->balance = $balance;
        return $this;
    }
}
