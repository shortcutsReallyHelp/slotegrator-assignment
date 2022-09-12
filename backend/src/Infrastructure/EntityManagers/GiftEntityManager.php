<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\EntityManagers;

use Doctrine\ORM\EntityManagerInterface;
use Slotegrator\Business\Gift\DTO\AddGift;
use Slotegrator\Business\Gift\DTO\WithdrawGift;
use Slotegrator\Business\Gift\GiftEntityManagerInterface;
use Slotegrator\Infrastructure\Entities\Gift;
use Slotegrator\Infrastructure\Entities\GiftTransaction;
use Slotegrator\Infrastructure\Mapper\Gift\GiftMapperInterface;

class GiftEntityManager implements GiftEntityManagerInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function withdrawGift(WithdrawGift $withdrawGift): void
    {
        $gift = $this->entityManager->getRepository(Gift::class)->find($withdrawGift->getGiftId());
        $gift->setBalance($gift->getBalance() - $withdrawGift->getAmount());
        $gift->setUpdatedAt(new \DateTime());

        $this->withdrawGiftTransaction($withdrawGift, $gift);
        $this->entityManager->persist($gift);

        $this->entityManager->flush();
    }

    public function add(AddGift $addGift): void
    {
        $gift = $this->entityManager->getRepository(Gift::class)->find($addGift->getGiftId());
        $gift->setBalance($addGift->getAmount() + $addGift->getAmount());
        $gift->setUpdatedAt(new \DateTime());

        $this->addGiftTransaction($addGift, $gift);
        $this->entityManager->persist($gift);

        $this->entityManager->flush();
    }

    private function addGiftTransaction(AddGift $addGift, Gift $gift): void
    {
        $giftTransaction = new GiftTransaction();
        $giftTransaction->setGiftId($addGift->getGiftId());
        $giftTransaction->setAmount($addGift->getAmount());
        $giftTransaction->setUserId($addGift->getUserId());
        $giftTransaction->setGiftBalance($gift->getBalance());
        $giftTransaction->setCreatedAt(new \DateTime());
        $giftTransaction->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($giftTransaction);
    }

    private function withdrawGiftTransaction(WithdrawGift $withdrawGift, Gift $gift): void
    {
        $giftTransaction = new GiftTransaction();
        $giftTransaction->setGiftId($withdrawGift->getGiftId());
        $giftTransaction->setAmount(-1 * $withdrawGift->getAmount());
        $giftTransaction->setUserId(null);
        $giftTransaction->setGiftBalance($gift->getBalance());
        $giftTransaction->setCreatedAt(new \DateTime());
        $giftTransaction->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($giftTransaction);
    }
}
