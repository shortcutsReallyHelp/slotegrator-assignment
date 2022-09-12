<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift;

use Slotegrator\Business\Gift\DTO\AddGift;
use Slotegrator\Business\Gift\DTO\WithdrawGift;

interface GiftEntityManagerInterface
{
    public function withdrawGift(WithdrawGift $withdrawGift): int;
    public function addToUsersBalance(AddGift $addGift): int;
}
