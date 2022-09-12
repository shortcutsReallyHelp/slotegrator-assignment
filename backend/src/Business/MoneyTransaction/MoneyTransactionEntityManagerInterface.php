<?php declare(strict_types=1);

namespace Slotegrator\Business\MoneyTransaction;

use Slotegrator\Business\MoneyTransaction\Entities\MoneyTransaction;

interface MoneyTransactionEntityManagerInterface
{
    public function addMoneyTransaction(int $userId, int $amount): MoneyTransaction;
    public function withdrawFromUs(int $amount): MoneyTransaction;
    public function getBalance(): int;

    /**
     * @param int $limit
     * @return array<MoneyTransaction>
     */
    public function getWithdrawals(int $limit): array;

    public function markMoneyTransactionsProcessed(array $ids): void;
}
