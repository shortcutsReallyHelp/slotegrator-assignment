<?php declare(strict_types=1);

namespace Slotegrator\Business\BonusTransaction;

use Slotegrator\Business\BonusTransaction\Entities\BonusTransaction;

interface BonusTransactionServiceInterface
{
    public function addBonus(int $userId, int $amount): BonusTransaction;
}
