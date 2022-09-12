<?php declare(strict_types=1);

namespace Slotegrator\Http\Middlewares;

use Laminas\Diactoros\Response\JsonResponse;
use League\Route\Http\Exception\UnauthorizedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slotegrator\Business\Auth\AuthServiceInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(protected AuthServiceInterface $authService){}

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeaderLine('Authorization');
        if (empty($token)) {
            return new JsonResponse(['message' => 'Unauthorized'], 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $user = $this->authService->getUserByToken($token);

        if (empty($user)) {
            return new JsonResponse(['message' => 'Unauthorized'], 401);
        }

        $request = $request->withAttribute('user', $user);

        return $handler->handle($request);
    }
}
