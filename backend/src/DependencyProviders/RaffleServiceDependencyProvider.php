<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use Doctrine\ORM\EntityManager;
use League\Container\Container;
use Slotegrator\Application\Raffle\CommandHandler\PlayCommandHandler;
use Slotegrator\Application\Raffle\CommandHandler\PlayCommandHandlerInterface;
use Slotegrator\Business\Gift\GiftServiceInterface;
use Slotegrator\Business\Raffle\Factory\ProbabilityFactory;
use Slotegrator\Business\Raffle\ProbabilityGenerator\ProbabilityGenerator;
use Slotegrator\Business\Raffle\ProbabilityGenerator\ProbabilityGeneratorInterface;
use Slotegrator\Business\Raffle\RaffleEntityManagerInterface;
use Slotegrator\Business\Raffle\RaffleService;
use Slotegrator\Business\Raffle\RaffleServiceInterface;
use Slotegrator\Business\Raffle\Randomiser\Randomiser;
use Slotegrator\Business\Raffle\Randomiser\RandomiserInterface;
use Slotegrator\Business\Raffle\Writer\RaffleWriter;
use Slotegrator\Business\Raffle\Writer\RaffleWriterInterface;
use Slotegrator\Infrastructure\EntityManagers\RaffleEntityManager;
use Slotegrator\Infrastructure\Mapper\Raffle\RaffleMapper;
use Slotegrator\Infrastructure\Mapper\Raffle\RaffleMapperInterface;

class RaffleServiceDependencyProvider implements DependencyProviderInterface
{
    public function boot(Container $container): Container
    {
        $container->add(RaffleServiceInterface::class, function () use ($container) {
            return new RaffleService(
                $container->get(ProbabilityGeneratorInterface::class),
                $container->get(RandomiserInterface::class),
                $container->get(RaffleWriterInterface::class)
            );
        });
        $container->add(ProbabilityFactory::class, function () use ($container) {
            return new ProbabilityFactory($container);
        });
        $container->add(ProbabilityGeneratorInterface::class, function () use ($container) {
            return new ProbabilityGenerator(
                $container->get(GiftServiceInterface::class),
                $container->get(ProbabilityFactory::class),
            );
        });
        $container->add(RandomiserInterface::class, function () {
            return new Randomiser();
        });
        $container->add(RaffleWriterInterface::class, function () use ($container) {
            return new RaffleWriter(
                $container->get(RaffleEntityManagerInterface::class)
            );
        });
        $container->add(RaffleEntityManagerInterface::class, function () use ($container) {
            return new RaffleEntityManager(
                $container->get(EntityManager::class),
                $container->get(RaffleMapperInterface::class),
            );
        });
        $container->add(RaffleMapperInterface::class, function () {
            return new RaffleMapper();
        });
        $container->add(PlayCommandHandlerInterface::class, function () use ($container) {
            return new PlayCommandHandler($container->get(RaffleServiceInterface::class));
        });

        return $container;
    }
}
