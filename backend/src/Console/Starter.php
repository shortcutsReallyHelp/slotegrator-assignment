<?php declare(strict_types=1);

namespace Slotegrator\Console;

use League\Container\Container;
use Slotegrator\DependencyProviders\ConfigDependencyProvider;
use Slotegrator\DependencyProviders\DependencyProviderInterface;
use Slotegrator\DependencyProviders\ConsoleDependencyProvider;
use Slotegrator\DependencyProviders\DoctrineDependencyProvider;
use Slotegrator\DependencyProviders\DotEnvDependencyProvider;
use Slotegrator\DependencyProviders\TranslatorDependencyProvider;
use Slotegrator\DependencyProviders\ValidatorDependencyProvider;

class Starter
{

    /**
     * @var string[]
     */
    private array $dependencyProviders = [
        DotEnvDependencyProvider::class,
        ConfigDependencyProvider::class,
        ValidatorDependencyProvider::class,
        TranslatorDependencyProvider::class,
        ConsoleDependencyProvider::class,
        DoctrineDependencyProvider::class,
    ];

    /**
     * @return Container
     */
    public function __invoke(): Container
    {
        $container = new Container();
        $container = $this->bootDependencyProviders($container);

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
}
