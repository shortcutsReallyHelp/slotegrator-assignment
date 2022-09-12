<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift;

use Slotegrator\Business\Gift\Entities\Gift;
use Slotegrator\Business\Gift\Reader\GiftReaderInterface;
use Slotegrator\Business\Gift\TransactionWriter\TransactionWriter;

class GiftService implements GiftServiceInterface
{
    public function __construct(private GiftReaderInterface $giftReader, private TransactionWriter $transactionWriter){}

    public function transferGiftToUser(int $userId, Gift $gift): int
    {
        return $this->transactionWriter->transferGiftToUser($userId, $gift);
    }

    public function getAvailableGifts(): array
    {
        return $this->giftReader->getGifts();
    }

    public function getGiftByTransactionId(int $giftTransactionId): Gift
    {
        return $this->giftReader->getGiftByTransactionId($giftTransactionId);
    }
}
