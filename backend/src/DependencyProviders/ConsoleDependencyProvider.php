<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
use Doctrine\Migrations\Tools\Console\Command\UpToDateCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use League\Container\Container;

class ConsoleDependencyProvider implements DependencyProviderInterface
{
    public const COMMANDS = 'commands';

    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(self::COMMANDS, function () use ($container) {
            return [
                // Migrations Commands
                new DiffCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new DumpSchemaCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new ExecuteCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new GenerateCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new LatestCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new ListCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new MigrateCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new RollupCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new StatusCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new SyncMetadataCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new VersionCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new UpToDateCommand($container->get(DoctrineDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
            ];
        });


        return $container;
    }
}
