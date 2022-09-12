<?php declare(strict_types=1);

namespace Slotegrator\Business\Gift\Reader;

use Slotegrator\Business\Gift\Entities\Gift;

interface GiftReaderInterface
{
    /**
     * @return Gift[]
     */
    public function getGifts(): array;
}
