<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use Doctrine\ORM\EntityManager;
use League\Container\Container;
use Slotegrator\Business\Gift\GiftEntityManagerInterface;
use Slotegrator\Business\Gift\GiftRepositoryInterface;
use Slotegrator\Business\Gift\GiftService;
use Slotegrator\Business\Gift\GiftServiceInterface;
use Slotegrator\Business\Gift\Reader\GiftReader;
use Slotegrator\Business\Gift\Reader\GiftReaderInterface;
use Slotegrator\Business\Gift\TransactionWriter\TransactionWriter;
use Slotegrator\Business\Gift\TransactionWriter\TransactionWriterInterface;
use Slotegrator\Infrastructure\EntityManagers\GiftEntityManager;
use Slotegrator\Infrastructure\Mapper\Gift\GiftMapper;
use Slotegrator\Infrastructure\Mapper\Gift\GiftMapperInterface;
use Slotegrator\Infrastructure\Repositories\GiftRepository;

class GiftDependencyProvider implements DependencyProviderInterface
{

    public function boot(Container $container): Container
    {
        $container->add(TransactionWriterInterface::class, function () use ($container) {
            return new TransactionWriter(
                $container->get(GiftEntityManagerInterface::class)
            );
        });
        $container->add(GiftEntityManagerInterface::class, function () use ($container) {
            return new GiftEntityManager(
                $container->get(EntityManager::class)
            );
        });
        $container->add(GiftReaderInterface::class, function () use ($container) {
            return new GiftReader(
                $container->get(GiftRepositoryInterface::class)
            );
        });
        $container->add(GiftRepositoryInterface::class, function () use ($container) {
            return new GiftRepository(
                $container->get(EntityManager::class),
                $container->get(GiftMapperInterface::class)
            );
        });
        $container->add(GiftMapperInterface::class, function () use ($container) {
            return new GiftMapper();
        });
        $container->add(GiftServiceInterface::class, function () use ($container) {
            return new GiftService(
                $container->get(GiftReaderInterface::class),
                $container->get(TransactionWriterInterface::class)
            );
        });

        return $container;
    }
}
