<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Slotegrator\Business\Gift\GiftRepositoryInterface;
use Slotegrator\Infrastructure\Entities\Gift;
use Slotegrator\Infrastructure\Mapper\User\UserMapperInterface;

class GiftRepository implements GiftRepositoryInterface
{
    public function __construct(protected EntityManagerInterface $entityManager, protected UserMapperInterface $userMapper) {}

    public function getAvailableGifts(): array
    {
        $gifts = $this->entityManager
            ->getRepository(Gift::class)
            ->createQueryBuilder('gifts')
            ->where('gifts.balance > 0')
            ->getQuery()
            ->getResult();

        return array_map(fn($gift) => $this->userMapper->mapToDomain($gift), $gifts);
    }

}
