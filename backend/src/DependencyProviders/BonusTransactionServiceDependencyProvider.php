<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use Doctrine\ORM\EntityManager;
use League\Container\Container;
use Slotegrator\Business\BonusTransaction\BonusTransactionEntityManagerInterface;
use Slotegrator\Business\BonusTransaction\BonusTransactionService;
use Slotegrator\Business\BonusTransaction\BonusTransactionServiceInterface;
use Slotegrator\Infrastructure\EntityManagers\BonusTransactionEntityManager;

class BonusTransactionServiceDependencyProvider implements DependencyProviderInterface
{
    public function boot(Container $container): Container
    {
        $container->add(BonusTransactionServiceInterface::class, function () use ($container) {
            return new BonusTransactionService(
                $container->get(BonusTransactionEntityManagerInterface::class)
            );
        });
        $container->add(BonusTransactionEntityManagerInterface::class, function () use ($container) {
            return new BonusTransactionEntityManager(
                $container->get(EntityManager::class),
            );
        });
        return $container;
    }
}
