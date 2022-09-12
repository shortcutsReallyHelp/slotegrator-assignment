<?php declare(strict_types=1);

namespace Slotegrator\Http\Routes;

use League\Container\Container;
use League\Route\RouteGroup;
use League\Route\Router;
use Slotegrator\Http\Controllers\RaffleController;
use Slotegrator\Http\Controllers\SignInController;
use Slotegrator\Http\Controllers\SignupController;
use Slotegrator\Http\Middlewares\AuthMiddleware;
use Slotegrator\Http\Middlewares\BodyParserMiddleware;

class ApiRoutesProvider implements RoutesProviderInterface
{
    /**
     * @param Router $router
     * @param Container $container
     * @return Router
     */
    public function boot(Router $router, Container $container): Router
    {
        $router->group('/api', function (RouteGroup $routeGroup) use ($container) {
            $routeGroup->post('signup', $this->resolveController($container, SignupController::class, 'signup'));
            $routeGroup->post('signin', $this->resolveController($container, SignInController::class, 'signIn'));
        })->middleware($container->get(BodyParserMiddleware::class));

        $router
            ->group('/api/raffle', function (RouteGroup $routeGroup) use ($container) {
                $routeGroup->post('play', $this->resolveController($container, RaffleController::class, 'play'));
            })
            ->middleware($container->get(BodyParserMiddleware::class))
            ->middleware($container->get(AuthMiddleware::class));


        return $router;
    }

    /**
     * @param Container $container
     * @param string $className
     * @param string $methodName
     * @return \Closure
     */
    private function resolveController(Container $container, string $className, string $methodName): \Closure
    {
        return function (...$args) use ($container, $className, $methodName) {
            return ($container->get($className))->$methodName(...$args);
        };
    }
}
