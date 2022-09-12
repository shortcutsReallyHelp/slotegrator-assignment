<?php declare(strict_types=1);

namespace Slotegrator\Infrastructure\EntityManagers;

use Doctrine\ORM\EntityManagerInterface;
use Slotegrator\Business\Raffle\Entities\Raffle;
use Slotegrator\Business\Raffle\RaffleEntityManagerInterface;
use Slotegrator\Infrastructure\Mapper\Raffle\RaffleMapperInterface;

class RaffleEntityManager implements RaffleEntityManagerInterface
{
    public function __construct(private EntityManagerInterface $entityManager, private RaffleMapperInterface $raffleMapper) {}

    public function createRaffle(Raffle $raffle): Raffle
    {
        $raffle->setCreatedAt(new \DateTime());
        $raffle->setUpdatedAt(new \DateTime());
        $raffleEntity = $this->raffleMapper->map($raffle);

        $this->entityManager->persist($raffleEntity);
        $this->entityManager->flush();

        return $raffle;
    }

}
