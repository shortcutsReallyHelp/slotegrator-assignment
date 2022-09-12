<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\RaffleProbability;

use Slotegrator\Business\MoneyTransaction\Exceptions\NotEnoughMoneyException;
use Slotegrator\Business\MoneyTransaction\MoneyTransactionServiceInterface;
use Slotegrator\Business\Raffle\Entities\Raffle;
use Slotegrator\Business\Raffle\RaffleEntityManagerInterface;
use Slotegrator\Business\Raffle\Randomiser\RandomiserInterface;

class MoneyProbability implements RaffleProbabilityInterface
{
    private int $balance;

    public function __construct(
        private MoneyTransactionServiceInterface $moneyTransactionService,
        private RaffleEntityManagerInterface $raffleEntityManager,
        private RandomiserInterface $randomiser,
        private int $max,
        private int $min,
    ) {
        $this->balance = $this->moneyTransactionService->getBalance();

        if ($this->balance < $this->min) {
            throw new NotEnoughMoneyException();
        }
    }

    public function play(int $userId): Raffle
    {
        $max = min($this->balance, $this->max);
        $amount = $this->randomiser->getRandomNumber($this->min, $max);

        $this->moneyTransactionService->withdrawFromUs($amount);
        $moneyTransaction = $this->moneyTransactionService->addToUser($userId, $amount);

        return $this->raffleEntityManager->createRaffle(
            (new Raffle())
                ->setMoneyTransactionId($moneyTransaction->getId())
                ->setMoneyAmount($moneyTransaction->getAmount())
                ->setUserId($userId)
                ->setType(Raffle::TYPE_MONEY)
        );
    }
}
