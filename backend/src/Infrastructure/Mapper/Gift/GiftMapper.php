<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Mapper\Gift;

use Slotegrator\Business\Gift\Entities\Gift;
use Slotegrator\Infrastructure\Entities\Gift as InfrastructureGift;

class GiftMapper implements GiftMapperInterface
{
    public function map(Gift $gift): InfrastructureGift
    {
        $infrastructureGift = new InfrastructureGift();

        if ($gift->getId()) {
            $infrastructureGift->setId($gift->getId());
        }
        $infrastructureGift->setName($gift->getName());
        $infrastructureGift->setBalance($gift->getBalance());

        return $infrastructureGift;
    }

    public function mapToDomain(InfrastructureGift $gift): Gift
    {
        return new Gift(
            $gift->getId(),
            $gift->getName(),
            $gift->getBalance(),
        );
    }
}
