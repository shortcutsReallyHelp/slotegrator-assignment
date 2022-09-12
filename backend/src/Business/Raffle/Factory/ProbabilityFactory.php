<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\Factory;

use League\Config\Configuration;
use League\Container\Container;
use Slotegrator\Business\BonusTransaction\BonusTransactionServiceInterface;
use Slotegrator\Business\Gift\GiftServiceInterface;
use Slotegrator\Business\MoneyTransaction\MoneyTransactionServiceInterface;
use Slotegrator\Business\Raffle\RaffleProbability\BonusProbability;
use Slotegrator\Business\Raffle\RaffleProbability\GiftProbability;
use Slotegrator\Business\Raffle\RaffleEntityManagerInterface;
use Slotegrator\Business\Raffle\RaffleProbability\MoneyProbability;
use Slotegrator\Business\Raffle\Randomiser\RandomiserInterface;

class ProbabilityFactory
{
    public function __construct(private Container $container){}

    /**
     * @return GiftProbability
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function createGiftProbability(): GiftProbability
    {
        return new GiftProbability(
            $this->container->get(GiftServiceInterface::class),
            $this->container->get(RaffleEntityManagerInterface::class),
            $this->container->get(RandomiserInterface::class),
        );
    }

    public function createBonusProbability(): BonusProbability
    {
        return new BonusProbability(
            $this->container->get(BonusTransactionServiceInterface::class),
            $this->container->get(RaffleEntityManagerInterface::class),
            $this->container->get(RandomiserInterface::class),
            $this->container->get(Configuration::class)->get('application.raffle_bonus_max'),
            $this->container->get(Configuration::class)->get('application.raffle_bonus_min'),
        );
    }

    public function createMoneyProbability(): MoneyProbability
    {
        return new MoneyProbability(
            $this->container->get(MoneyTransactionServiceInterface::class),
            $this->container->get(RaffleEntityManagerInterface::class),
            $this->container->get(RandomiserInterface::class),
            $this->container->get(Configuration::class)->get('application.raffle_money_max'),
            $this->container->get(Configuration::class)->get('application.raffle_money_min'),
        );
    }
}
