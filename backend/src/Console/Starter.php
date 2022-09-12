<?php declare(strict_types=1);

namespace Slotegrator\Console;

use League\Container\Container;
use Slotegrator\DependencyProviders\AuthServiceDependencyProvider;
use Slotegrator\DependencyProviders\BonusTransactionServiceDependencyProvider;
use Slotegrator\DependencyProviders\ConfigDependencyProvider;
use Slotegrator\DependencyProviders\DependencyProviderInterface;
use Slotegrator\DependencyProviders\ConsoleDependencyProvider;
use Slotegrator\DependencyProviders\DoctrineDependencyProvider;
use Slotegrator\DependencyProviders\DotEnvDependencyProvider;
use Slotegrator\DependencyProviders\GiftDependencyProvider;
use Slotegrator\DependencyProviders\MoneyTransactionServiceDependencyProvider;
use Slotegrator\DependencyProviders\RaffleServiceDependencyProvider;
use Slotegrator\DependencyProviders\ServiceDependencyProvider;
use Slotegrator\DependencyProviders\TranslatorDependencyProvider;
use Slotegrator\DependencyProviders\UserServiceDependencyProvider;
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
        ServiceDependencyProvider::class,
        AuthServiceDependencyProvider::class,
        UserServiceDependencyProvider::class,
        GiftDependencyProvider::class,
        RaffleServiceDependencyProvider::class,
        BonusTransactionServiceDependencyProvider::class,
        MoneyTransactionServiceDependencyProvider::class,
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
