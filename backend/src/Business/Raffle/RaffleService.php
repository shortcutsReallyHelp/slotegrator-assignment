<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle;

use Slotegrator\Business\Raffle\Entities\Raffle;
use Slotegrator\Business\Raffle\ProbabilityGenerator\ProbabilityGeneratorInterface;
use Slotegrator\Business\Raffle\RaffleProbability\RaffleProbabilityInterface;
use Slotegrator\Business\Raffle\Randomiser\RandomiserInterface;
use Slotegrator\Business\Raffle\Writer\RaffleWriterInterface;

class RaffleService implements RaffleServiceInterface
{
    public function __construct(
        protected ProbabilityGeneratorInterface $probabilityGenerator,
        protected RandomiserInterface $randomiser,
        protected RaffleWriterInterface $raffleWriter,
    ){}

    public function play(int $userId): Raffle
    {
        $probabilities = $this->probabilityGenerator->generate();
        $randomNumber = $this->randomiser->getRandomNumber(0, count($probabilities) - 1);

        /** @var RaffleProbabilityInterface $probability */
        $probability = $probabilities[$randomNumber];
        return $probability->play($userId);
    }

}
