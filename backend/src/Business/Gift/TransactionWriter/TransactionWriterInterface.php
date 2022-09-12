<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift\TransactionWriter;

use Slotegrator\Business\Gift\Entities\Gift;

interface TransactionWriterInterface
{
    public function transferGiftToUser(int $userId, Gift $gift): Gift;
}
