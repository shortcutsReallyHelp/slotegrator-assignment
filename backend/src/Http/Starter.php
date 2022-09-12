<?php declare(strict_types=1);

namespace Slotegrator\Http;

use League\Container\Container;
use League\Route\Router;
use Slotegrator\DependencyProviders\AuthServiceDependencyProvider;
use Slotegrator\DependencyProviders\BodyParserDependencyProvider;
use Slotegrator\DependencyProviders\ConfigDependencyProvider;
use Slotegrator\DependencyProviders\ControllerDependencyProvider;
use Slotegrator\DependencyProviders\DependencyProviderInterface;
use Slotegrator\DependencyProviders\DoctrineDependencyProvider;
use Slotegrator\DependencyProviders\DotEnvDependencyProvider;
use Slotegrator\DependencyProviders\GiftDependencyProvider;
use Slotegrator\DependencyProviders\RequestDependencyProvider;
use Slotegrator\DependencyProviders\ServiceDependencyProvider;
use Slotegrator\DependencyProviders\TranslatorDependencyProvider;
use Slotegrator\DependencyProviders\UserServiceDependencyProvider;
use Slotegrator\DependencyProviders\ValidatorDependencyProvider;
use Slotegrator\Http\Routes\ApiRoutesProvider;
use Slotegrator\Http\Routes\RoutesProviderInterface;

class Starter
{
    public const ROUTER = 'router';

    /**
     * @var string[]
     */
    private array $dependencyProviders = [
        DotEnvDependencyProvider::class,
        ConfigDependencyProvider::class,
        ValidatorDependencyProvider::class,
        ControllerDependencyProvider::class,
        TranslatorDependencyProvider::class,
        RequestDependencyProvider::class,
        BodyParserDependencyProvider::class,
        DoctrineDependencyProvider::class,
        ServiceDependencyProvider::class,
        AuthServiceDependencyProvider::class,
        UserServiceDependencyProvider::class,
        GiftDependencyProvider::class,
    ];

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
        //put to RouterDependencyProvider
        $container->add(self::ROUTER, function () use ($container) {
            $router = new Router();
            foreach ($this->routesProviders as $routesProviderClassName) {
                /**
                 * @var RoutesProviderInterface $routesProvider
                 */
                $routesProvider = new $routesProviderClassName;
                $router = $routesProvider->boot($router, $container);
            }
            return $router;
        });
        return $container;
    }
}
