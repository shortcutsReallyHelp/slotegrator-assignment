<?php declare(strict_types=1);

namespace Slotegrator\Http;

use League\Container\Container;
use League\Route\Router;
use Slotegrator\DependencyProviders\DependencyProviderInterface;
use Slotegrator\Http\Routes\ApiRoutesProvider;
use Slotegrator\Http\Routes\RoutesProviderInterface;

class Starter
{
    public const ROUTER = 'router';

    /**
     * @var string[]
     */
    private array $dependencyProviders = [];

    /**
     * @var array|string[]
     */
    private array $routesProviders = [
        ApiRoutesProvider::class,
    ];

    /**
     * @return Container
     */
    public function __invoke(): Container
    {
        $container = new Container();
        $container = $this->bootDependencyProviders($container);
        $container = $this->bootRoutes($container);

        return $container;
    }

    /**
     * @param Container $container
     * @return Container
     */
    private function bootDependencyProviders(Container $container): Container
    {
        foreach ($this->dependencyProviders as $dependencyProviderClassName) {
            /**
             * @var DependencyProviderInterface $dependencyProvider
             */
            $dependencyProvider = new $dependencyProviderClassName;
            $container = $dependencyProvider->boot($container);
        }
        return $container;
    }

    /**
     * @param Container $container
     * @return Container
     */
    private function bootRoutes(Container $container): Container
    {
        $container->add(self::ROUTER, function () {
            $router = new Router();
            foreach ($this->routesProviders as $routesProviderClassName) {
                /**
                 * @var RoutesProviderInterface $routesProvider
                 */
                $routesProvider = new $routesProviderClassName;
                $router = $routesProvider->boot($router);
            }
            return $router;
        });
        return $container;
    }
}
