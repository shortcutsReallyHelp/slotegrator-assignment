<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Mapper\Gift;

use Slotegrator\Business\Gift\Entities\Gift;
use Slotegrator\Infrastructure\Entities\Gift as InfrastructureGift;

interface GiftMapperInterface
{
    public function map(Gift $gift): InfrastructureGift;
    public function mapToDomain(InfrastructureGift $gift): Gift;
}
