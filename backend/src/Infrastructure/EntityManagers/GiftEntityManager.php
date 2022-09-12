<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\EntityManagers;

use Doctrine\ORM\EntityManagerInterface;
use Slotegrator\Business\Gift\DTO\AddGift;
use Slotegrator\Business\Gift\DTO\WithdrawGift;
use Slotegrator\Business\Gift\GiftEntityManagerInterface;
use Slotegrator\Infrastructure\Entities\Gift;
use Slotegrator\Infrastructure\Entities\GiftTransaction;

class GiftEntityManager implements GiftEntityManagerInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function withdrawGift(WithdrawGift $withdrawGift): int
    {
        $gift = $this->entityManager->getRepository(Gift::class)->find($withdrawGift->getGiftId());

        $gift->setBalance($gift->getBalance() - $withdrawGift->getAmount());
        $gift->setUpdatedAt(new \DateTime());
        $this->entityManager->persist($gift);
        $this->entityManager->flush();

        return $this->withdrawGiftTransaction($withdrawGift, $gift);
    }

    public function addToUsersBalance(AddGift $addGift): int
    {
        $giftTransaction = $this->entityManager->getRepository(GiftTransaction::class)
            ->findOneBy(['giftId' => $addGift->getGiftId(), 'userId' => $addGift->getUserId()], ['id' => 'DESC']);

        $newBalance = 0;
        if ($giftTransaction) {
            $newBalance = $giftTransaction->getGiftBalance() + $addGift->getAmount();
        }

        $giftTransaction = new GiftTransaction();
        $giftTransaction->setGiftId($addGift->getGiftId());
        $giftTransaction->setUserId($addGift->getUserId());
        $giftTransaction->setGiftBalance($newBalance);
        $giftTransaction->setAmount($addGift->getAmount());
        $giftTransaction->setCreatedAt(new \DateTime());
        $giftTransaction->setUpdatedAt(new \DateTime());
        $this->entityManager->persist($giftTransaction);
        $this->entityManager->flush();

        return $giftTransaction->getId();
    }

    private function withdrawGiftTransaction(WithdrawGift $withdrawGift, Gift $gift): int
    {
        $giftTransaction = new GiftTransaction();
        $giftTransaction->setGiftId($withdrawGift->getGiftId());
        $giftTransaction->setAmount(-1 * $withdrawGift->getAmount());
        $giftTransaction->setUserId(null);
        $giftTransaction->setGiftBalance($gift->getBalance());
        $giftTransaction->setCreatedAt(new \DateTime());
        $giftTransaction->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($giftTransaction);
        $this->entityManager->flush();

        return $giftTransaction->getId();
    }
}
