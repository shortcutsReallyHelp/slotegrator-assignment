<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift\Reader;

use Slotegrator\Business\Gift\Entities\Gift;
use Slotegrator\Business\Gift\GiftRepositoryInterface;

class GiftReader implements GiftReaderInterface
{
    public function __construct(private GiftRepositoryInterface $giftRepository) {}

    /**
     * @return Gift[]
     */
    public function getGifts(): array
    {
        return $this->giftRepository->getAvailableGifts();
    }

    public function getGiftByTransactionId(int $giftTransactionId): Gift
    {
        return $this->giftRepository->getGiftByTransactionId($giftTransactionId);
    }
}
