<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\RaffleProbability;

use Slotegrator\Business\BonusTransaction\BonusTransactionServiceInterface;
use Slotegrator\Business\Raffle\Entities\Raffle;
use Slotegrator\Business\Raffle\RaffleEntityManagerInterface;
use Slotegrator\Business\Raffle\Randomiser\RandomiserInterface;

class BonusProbability implements RaffleProbabilityInterface
{
    public function __construct(
        private BonusTransactionServiceInterface $bonusTransactionService,
        private RaffleEntityManagerInterface $raffleEntityManager,
        private RandomiserInterface $randomiser,
        private int $max,
        private int $min,
    ) {
    }

    /**
     * @param int $userId
     * @return Raffle
     */
    public function play(int $userId): Raffle
    {
        $bonusTransaction = $this->bonusTransactionService->addBonus($userId, $this->randomiser->getRandomNumber($this->min, $this->max));

        return $this->raffleEntityManager->createRaffle(
            (new Raffle())
                ->setBonusTransactionId($bonusTransaction->getId())
                ->setBonusAmount($bonusTransaction->getAmount())
                ->setUserId($userId)
                ->setType(Raffle::TYPE_BONUS)
        );
    }
}
