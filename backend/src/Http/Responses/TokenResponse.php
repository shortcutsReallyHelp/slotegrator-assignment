<?php declare(strict_types=1);

namespace Slotegrator\Http\Responses;

use Laminas\Diactoros\Response\JsonResponse;

class TokenResponse extends JsonResponse
{
    public function __construct(string $token)
    {
        parent::__construct([
            'data' => [
                'token' => $token
            ],
        ]);
    }
}
