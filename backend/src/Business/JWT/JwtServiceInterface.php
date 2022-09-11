<?php declare(strict_types=1);

namespace Slotegrator\Business\JWT;

interface JwtServiceInterface
{
    /**
     * @param array $payload
     * @return string
     */
    public function encode(array $payload): string;

    /**
     * @param string $token
     * @return array
     */
    public function decode(string $token): array;
}
