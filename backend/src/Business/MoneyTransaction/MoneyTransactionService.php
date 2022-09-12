<?php declare(strict_types=1);

namespace Slotegrator\Business\MoneyTransaction;

use Slotegrator\Business\MoneyTransaction\Entities\MoneyTransaction;

class MoneyTransactionService implements MoneyTransactionServiceInterface
{
    public function __construct(private MoneyTransactionEntityManagerInterface $entityManager)
    {}

    /**
     * @param int $amount
     * @return MoneyTransaction
     */
    public function withdrawFromUs(int $amount): MoneyTransaction
    {
        return $this->entityManager->withdrawFromUs($amount);
    }

    public function addToUser(int $userId, int $amount): MoneyTransaction
    {
        return $this->entityManager->addMoneyTransaction($userId, $amount);
    }

    public function getBalance(): int
    {
        //i would seperate these calls to writer and reader and use repository but inssuficient time
        return $this->entityManager->getBalance();
    }

    /**
     * @param int $limit
     * @return array<MoneyTransaction>
     */
    public function getWithdrawals(int $limit): array
    {
        return $this->entityManager->getWithdrawals($limit);
    }

    public function markMoneyTransactionsProcessed(array $ids): void
    {
        $this->entityManager->markMoneyTransactionsProcessed($ids);
    }
}
