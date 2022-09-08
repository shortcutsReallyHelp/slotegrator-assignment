<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

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
                new DumpSchemaCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new ExecuteCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new GenerateCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new LatestCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new ListCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new MigrateCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new RollupCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new StatusCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new SyncMetadataCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new VersionCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
                new UpToDateCommand($container->get(DoctrineMigrationDependencyProvider::DOCTRINE_DEPENDENCY_FACTORY)),
            ];
        });


        return $container;
    }
}
