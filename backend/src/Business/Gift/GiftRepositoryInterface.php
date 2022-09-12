<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift;

interface GiftRepositoryInterface
{
    public function getAvailableGifts(): array;
}
