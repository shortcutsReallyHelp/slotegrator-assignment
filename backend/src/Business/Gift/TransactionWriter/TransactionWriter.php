<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift\TransactionWriter;

use Slotegrator\Business\Gift\DTO\AddGift;
use Slotegrator\Business\Gift\DTO\WithdrawGift;
use Slotegrator\Business\Gift\Entities\Gift;
use Slotegrator\Business\Gift\GiftEntityManagerInterface;

class TransactionWriter implements TransactionWriterInterface
{
    public function __construct(private GiftEntityManagerInterface $giftEntityManager){}

    public function transferGiftToUser(int $userId, Gift $gift): Gift
    {
        $this->giftEntityManager->withdrawGift(new WithdrawGift($gift->getId()));
        $this->giftEntityManager->add(new AddGift($gift->getId(), $userId));

        return $gift;
    }
}
