<?php declare(strict_types=1);

namespace Slotegrator\Business\BonusTransaction;

use Slotegrator\Business\BonusTransaction\Entities\BonusTransaction;

class BonusTransactionService implements BonusTransactionServiceInterface
{
    public function __construct(private BonusTransactionEntityManagerInterface $entityManager)
    {}

    public function addBonus(int $userId, int $amount): BonusTransaction
    {
        return $this->entityManager->addBonus($userId, $amount);
    }
}
