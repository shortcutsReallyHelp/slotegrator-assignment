<?php declare(strict_types=1);

namespace Slotegrator\Business\Raffle\RaffleProbability;

use Slotegrator\Business\Common\Exceptions\BusinessException;
use Slotegrator\Business\Gift\Entities\Gift;
use Slotegrator\Business\Gift\GiftServiceInterface;
use Slotegrator\Business\Raffle\Entities\Raffle;
use Slotegrator\Business\Raffle\RaffleEntityManagerInterface;
use Slotegrator\Business\Raffle\Randomiser\RandomiserInterface;

class GiftProbability implements RaffleProbabilityInterface
{
    private array $gifts = [];

    public function __construct(
        private GiftServiceInterface $giftService,
        private RaffleEntityManagerInterface $raffleEntityManager,
        private RandomiserInterface $randomiser
    ) {
        $this->gifts = $this->giftService->getAvailableGifts();

        if (empty($this->gifts)) {
            throw new BusinessException('No gifts available');
        }
    }

    public function play(int $userId): Raffle
    {
        $giftTransactionId = $this->giftService->transferGiftToUser($userId, $this->gifts[$this->randomiser->getRandomNumber(0, count($this->gifts) - 1)]);
        $gift = $this->giftService->getGiftByTransactionId($giftTransactionId);

        $this->gifts = [];

        return $this->raffleEntityManager->createRaffle(
            (new Raffle())
                ->setGiftId($gift->getId())
                ->setUserId($userId)
                ->setGiftName($gift->getName())
                ->setGiftTransactionId($giftTransactionId)
                ->setType(Raffle::TYPE_GIFT)
        );
    }
}
