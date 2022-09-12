<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\EntityManagers;

use Doctrine\ORM\EntityManagerInterface;
use Slotegrator\Business\BonusTransaction\BonusTransactionEntityManagerInterface;
use Slotegrator\Business\BonusTransaction\Entities\BonusTransaction as BusinessBonusTransaction;
use Slotegrator\Infrastructure\Entities\BonusTransaction;

class BonusTransactionEntityManager implements BonusTransactionEntityManagerInterface
{
    public function __construct(private EntityManagerInterface $entityManager){}

    public function addBonus(int $userId, int $amount): BusinessBonusTransaction
    {
        //i would like to refactor this place, because EntityManagers must do only CRUD stuff, not calculations
        //but i unfortunately don't have enough time to do it
        $newBalance = $this->getBalance($userId) + $amount;

        $transaction = (new BonusTransaction())->setAmount($amount)->setUserId($userId)->setBalance($newBalance);

        $transaction->setUpdatedAt(new \DateTime());
        $transaction->setCreatedAt(new \DateTime());

        $this->entityManager->persist($transaction);
        $this->entityManager->flush();

        return new BusinessBonusTransaction($transaction->getId(), $transaction->getUserId(), $transaction->getAmount());
    }

    private function getBalance(int $userId): int
    {
        $transaction = $this->entityManager->getRepository(BonusTransaction::class)
            ->findOneBy(['userId' => $userId], ['id' => 'DESC']);

        return $transaction ? $transaction->getBalance() : 0;
    }

}
