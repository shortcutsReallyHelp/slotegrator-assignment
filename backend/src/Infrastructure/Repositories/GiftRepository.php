<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Slotegrator\Business\Gift\GiftRepositoryInterface;
use Slotegrator\Infrastructure\Entities\Gift;
use Slotegrator\Infrastructure\Entities\GiftTransaction;
use Slotegrator\Infrastructure\Mapper\Gift\GiftMapperInterface;
use Slotegrator\Business\Gift\Entities;

class GiftRepository implements GiftRepositoryInterface
{
    public function __construct(protected EntityManagerInterface $entityManager, protected GiftMapperInterface $giftMapper) {}

    public function getAvailableGifts(): array
    {
        $gifts = $this->entityManager
            ->getRepository(Gift::class)
            ->createQueryBuilder('gifts')
            ->where('gifts.balance > 0')
            ->getQuery()
            ->getResult();

        return array_map(fn($gift) => $this->giftMapper->mapToDomain($gift), $gifts);
    }

    public function getGiftByTransactionId(int $giftTransactionId): Entities\Gift
    {
        /**
         * @var GiftTransaction $giftTransaction
         */
        $giftTransaction = $this->entityManager
            ->getRepository(GiftTransaction::class)
            ->findOneBy(['id' => $giftTransactionId]);

        $gift = $this->entityManager
            ->getRepository(Gift::class)
            ->find($giftTransaction->getGiftId());

        return $this->giftMapper->mapToDomain($gift);
    }
}
