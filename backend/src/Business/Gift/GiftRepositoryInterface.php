<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift;

use Slotegrator\Business\Gift\Entities\Gift;

interface GiftRepositoryInterface
{
    public function getAvailableGifts(): array;

    public function getGiftByTransactionId(int $giftTransactionId): Gift;
}
