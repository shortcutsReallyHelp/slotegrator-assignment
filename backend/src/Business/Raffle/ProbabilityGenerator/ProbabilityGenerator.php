<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\ProbabilityGenerator;

use Slotegrator\Business\Gift\GiftServiceInterface;
use Slotegrator\Business\Raffle\Factory\ProbabilityFactory;

class ProbabilityGenerator implements ProbabilityGeneratorInterface
{
    public function __construct(
        protected GiftServiceInterface $giftService,
        protected ProbabilityFactory $probabilityFactory,
    ) {
    }

    public function generate(): array
    {
        return [
            ...$this->generateGiftProbabilities(),
            $this->probabilityFactory->createBonusProbability(),
            ...$this->generateMoneyProbability(),
        ];
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function generateGiftProbabilities(): array
    {
        try {
            return [$this->probabilityFactory->createGiftProbability()];
        } catch (\Exception $e) {
            return [];
        }
    }

    protected function generateMoneyProbability(): array
    {
        try {
            return [$this->probabilityFactory->createMoneyProbability()];
        } catch (\Exception $e) {
            return [];
        }
    }

}
