<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\Mapper\Raffle;

use Slotegrator\Business\Raffle\Entities\Raffle;
use Slotegrator\Infrastructure\Entities\Raffle as InfrastructureRaffle;


class RaffleMapper implements RaffleMapperInterface
{
    public function map(Raffle $raffle): InfrastructureRaffle
    {
        $infrastructureRaffle = new InfrastructureRaffle();
        if ($raffle->getId())
            $infrastructureRaffle->setId($raffle->getId());
        if ($raffle->getUserId())
            $infrastructureRaffle->setUserId($raffle->getUserId());
        if ($raffle->getType())
            $infrastructureRaffle->setType($raffle->getType());
        if ($raffle->getGiftId())
            $infrastructureRaffle->setGiftId($raffle->getGiftId());
        if ($raffle->getGiftName())
            $infrastructureRaffle->setGiftName($raffle->getGiftName());
        if ($raffle->getGiftAmount())
            $infrastructureRaffle->setGiftAmount($raffle->getGiftAmount());
        if ($raffle->getMoneyAmount())
            $infrastructureRaffle->setMoneyAmount($raffle->getMoneyAmount());
        if ($raffle->getMoneyTransactionId())
            $infrastructureRaffle->setMoneyTransactionId($raffle->getMoneyTransactionId());
        if ($raffle->getBonusAmount())
            $infrastructureRaffle->setBonusAmount($raffle->getBonusAmount());
        if ($raffle->getBonusTransactionId())
            $infrastructureRaffle->setBonusTransactionId($raffle->getBonusTransactionId());
        if ($raffle->getGiftTransactionId())
            $infrastructureRaffle->setGiftTransactionId($raffle->getGiftTransactionId());
        if ($raffle->getCreatedAt())
            $infrastructureRaffle->setCreatedAt($raffle->getCreatedAt());
        if ($raffle->getUpdatedAt())
            $infrastructureRaffle->setUpdatedAt($raffle->getUpdatedAt());

        return $infrastructureRaffle;
    }

    public function mapToDomain(InfrastructureRaffle $infrastructureRaffle): Raffle
    {
        $raffle = new Raffle();
        if ($infrastructureRaffle->getId())
            $raffle->setId($infrastructureRaffle->getId());
        if ($infrastructureRaffle->getUserId())
            $raffle->setUserId($infrastructureRaffle->getUserId());
        if ($infrastructureRaffle->getType())
            $raffle->setType($infrastructureRaffle->getType());
        if ($infrastructureRaffle->getGiftId())
            $raffle->setGiftId($infrastructureRaffle->getGiftId());
        if ($infrastructureRaffle->getGiftName())
            $raffle->setGiftName($infrastructureRaffle->getGiftName());
        if ($infrastructureRaffle->getGiftAmount())
            $raffle->setGiftAmount($infrastructureRaffle->getGiftAmount());
        if ($infrastructureRaffle->getMoneyAmount())
            $raffle->setMoneyAmount($infrastructureRaffle->getMoneyAmount());
        if ($infrastructureRaffle->getMoneyTransactionId())
            $raffle->setMoneyTransactionId($infrastructureRaffle->getMoneyTransactionId());
        if ($infrastructureRaffle->getBonusAmount())
            $raffle->setBonusAmount($infrastructureRaffle->getBonusAmount());
        if ($infrastructureRaffle->getBonusTransactionId())
            $raffle->setBonusTransactionId($infrastructureRaffle->getBonusTransactionId());
        if ($infrastructureRaffle->getCreatedAt())
            $raffle->setCreatedAt($infrastructureRaffle->getCreatedAt());
        if ($infrastructureRaffle->getGiftTransactionId())
            $raffle->setGiftTransactionId($infrastructureRaffle->getGiftTransactionId());
        if ($infrastructureRaffle->getUpdatedAt())
            $raffle->setUpdatedAt($infrastructureRaffle->getUpdatedAt());

        return $raffle;
    }
}
