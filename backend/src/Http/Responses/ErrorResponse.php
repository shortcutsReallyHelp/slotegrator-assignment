<?php declare(strict_types=1);

namespace Slotegrator\Http\Responses;

use Laminas\Diactoros\Response\JsonResponse;

class ErrorResponse extends JsonResponse
{
    /**
     * @param string $message
     * @param int $code
     * @param array $errors
     * @param array $headers
     */
    public function __construct(string $message, int $code = 400, array $errors = [], array $headers = [])
    {
        parent::__construct([
            'message' => $message,
            'errors' => $errors
        ], $code, $headers);
    }
}
