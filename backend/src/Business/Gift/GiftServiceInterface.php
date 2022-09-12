<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift;

use Slotegrator\Business\Gift\Entities\Gift;

interface GiftServiceInterface
{
    public function transferGiftToUser(int $userId, Gift $gift): Gift;

    public function getAvailableGifts(): array;
}
