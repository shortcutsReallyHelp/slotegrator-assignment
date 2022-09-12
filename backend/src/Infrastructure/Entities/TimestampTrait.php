<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Entities;

use Doctrine\ORM\Mapping\Column;

trait TimestampTrait
{
    #[Column(type: 'datetime', name: 'created_at')]
    private \DateTime $createdAt;

    #[Column(type: 'datetime', name: 'updated_at')]
    private \DateTime $updatedAt;

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
