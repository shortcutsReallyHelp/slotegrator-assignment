<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\EntityManagers;

use Doctrine\ORM\EntityManagerInterface;
use Slotegrator\Business\MoneyTransaction\Entities\MoneyTransaction as BusinessMoneyTransaction;
use Slotegrator\Business\MoneyTransaction\MoneyTransactionEntityManagerInterface;
use Slotegrator\Infrastructure\Entities\MoneyTransaction;

class MoneyTransactionEntityManager implements MoneyTransactionEntityManagerInterface
{
    public function __construct(private EntityManagerInterface $entityManager){}

    /**
     * @param int $amount
     * @return BusinessMoneyTransaction
     */
    public function withdrawFromUs(int $amount): BusinessMoneyTransaction
    {
        //i would like to refactor this place, because EntityManagers must do only CRUD stuff, not calculations
        //but i unfortunately don't have enough time to do it

        $newBalance = $this->getOurBalance() - $amount;

        $transaction = (new MoneyTransaction())->setAmount($amount)->setBalance($newBalance);

        $transaction->setUpdatedAt(new \DateTime());
        $transaction->setCreatedAt(new \DateTime());
        $transaction->setIsWithdrawalProcessed(false);

        $this->entityManager->persist($transaction);
        $this->entityManager->flush();

        return (new BusinessMoneyTransaction())
            ->setId($transaction->getId())
            ->setAmount($transaction->getAmount());
    }

    public function addMoneyTransaction(
        int $userId,
        int $amount
    ): BusinessMoneyTransaction {
        //i would like to refactor this place, because EntityManagers must do only CRUD stuff, not calculations
        //but i unfortunately don't have enough time to do it

        $newBalance = $this->getBalanceOfUser($userId) + $amount;

        $transaction = (new MoneyTransaction())->setAmount($amount)->setUserId($userId)->setBalance($newBalance);

        $transaction->setIsWithdrawalProcessed(false);
        $transaction->setUpdatedAt(new \DateTime());
        $transaction->setCreatedAt(new \DateTime());

        $this->entityManager->persist($transaction);
        $this->entityManager->flush();

        return (new BusinessMoneyTransaction())
            ->setId($transaction->getId())
            ->setUserId($transaction->getUserId())
            ->setAmount($transaction->getAmount());
    }

    public function getBalance(): int
    {
        return $this->getOurBalance();
    }

    public function markMoneyTransactionsProcessed(array $ids): void
    {
        $this->entityManager->createQueryBuilder()
            ->update(MoneyTransaction::class, 'mt')
            ->set('mt.isWithdrawalProcessed', true)
            ->where('mt.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->execute();
    }

    /**
     * @param int $limit
     * @return array<\Slotegrator\Business\MoneyTransaction\Entities\MoneyTransaction>
     */
    public function getWithdrawals(int $limit): array
    {
        $queryBuilder = $this->entityManager->getRepository(MoneyTransaction::class)->createQueryBuilder('t');
        $transactions = $queryBuilder->where('t.isWithdrawalProcessed = :isWithdrawalProcessed')
            ->andWhere('t.userId IS NOT NULL')
            ->setParameter(':isWithdrawalProcessed', false)
            ->setMaxResults($limit)
            ->orderBy('t.id', 'DESC')
            ->getQuery()
            ->getResult();

        $result = [];

        foreach ($transactions as $transaction) {
            $result[] = (new BusinessMoneyTransaction())
                ->setId($transaction->getId())
                ->setAmount($transaction->getAmount());
        }

        return $result;
    }

    private function getOurBalance(): int
    {
        $transaction = $this->entityManager->getRepository(MoneyTransaction::class)
            ->findOneBy(['userId' => null], ['id' => 'DESC']);

        return $transaction ? $transaction->getBalance() : 0;
    }

    private function getBalanceOfUser(int $userId): int
    {
        $transaction = $this->entityManager->getRepository(MoneyTransaction::class)
            ->findOneBy(['userId' => $userId], ['id' => 'DESC']);

        return $transaction ? $transaction->getBalance() : 0;
    }
}
