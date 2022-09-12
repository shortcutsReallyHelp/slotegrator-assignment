<?php declare(strict_types=1);

namespace Slotegrator\Application\JWT;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Slotegrator\Business\JWT\JwtServiceInterface;

class JWTService implements JWTServiceInterface
{
    public function __construct(protected string $secret, protected string $algorithm = 'HS256') {}

    /**
     * @param array $payload
     * @return string
     */
    public function encode(array $payload): string
    {
        return JWT::encode($payload, $this->secret, $this->algorithm);
    }

    /**
     * @param string $token
     * @return array
     */
    public function decode(string $token): array
    {
        return (array) JWT::decode($token, new Key($this->secret, $this->algorithm));
    }
}
