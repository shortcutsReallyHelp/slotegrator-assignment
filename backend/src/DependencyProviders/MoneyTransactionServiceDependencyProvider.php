<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use Doctrine\ORM\EntityManager;
use League\Container\Container;
use Slotegrator\Business\MoneyTransaction\MoneyTransactionEntityManagerInterface;
use Slotegrator\Business\MoneyTransaction\MoneyTransactionService;
use Slotegrator\Business\MoneyTransaction\MoneyTransactionServiceInterface;
use Slotegrator\Infrastructure\EntityManagers\MoneyTransactionEntityManager;

class MoneyTransactionServiceDependencyProvider implements DependencyProviderInterface
{
    public function boot(Container $container): Container
    {
        $container->add(MoneyTransactionServiceInterface::class, function () use ($container) {
            return new MoneyTransactionService(
                $container->get(MoneyTransactionEntityManagerInterface::class)
            );
        });
        $container->add(MoneyTransactionEntityManagerInterface::class, function () use ($container) {
            return new MoneyTransactionEntityManager(
                $container->get(EntityManager::class)
            );
        });

        return $container;
    }
}
