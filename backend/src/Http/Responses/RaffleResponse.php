<?php
declare(strict_types=1);

namespace Slotegrator\Http\Responses;

use Laminas\Diactoros\Response\JsonResponse;
use Slotegrator\Business\Raffle\Entities\Raffle;

class RaffleResponse extends JsonResponse
{
    public function __construct(Raffle $raffle, int $status = 200, array $headers = [])
    {
        $data = [
            'data' => [
                'id' => $raffle->getId(),
                'user_id' => $raffle->getUserId(),
                'type' => $raffle->getType(),
                'gift_id' => $raffle->getGiftId(),
                'gift_name' => $raffle->getGiftName(),
                'gift_amount' => $raffle->getGiftAmount(),
                'gift_transaction_id' => $raffle->getGiftTransactionId(),
                'money_amount' => $raffle->getMoneyAmount(),
                'money_transaction_id' => $raffle->getMoneyTransactionId(),
                'bonus_amount' => $raffle->getBonusAmount(),
                'bonus_transaction_id' => $raffle->getBonusTransactionId(),
                'created_at' => $raffle->getCreatedAt(),
                'updated_at' => $raffle->getUpdatedAt(),
            ],
        ];
        parent::__construct($data, $status, $headers);
    }
}
