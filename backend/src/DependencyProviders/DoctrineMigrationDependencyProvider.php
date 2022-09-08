<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ExistingConfiguration;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Metadata\Storage\TableMetadataStorageConfiguration;
use League\Config\Configuration as SlotegratorConfig;
use League\Container\Container;

class DoctrineMigrationDependencyProvider implements DependencyProviderInterface
{
    public const DOCTRINE_DEPENDENCY_FACTORY = 'doctrine_dependency_factory';

    public function boot(Container $container): Container
    {
        $container->add(self::DOCTRINE_DEPENDENCY_FACTORY, function () use ($container) {
            /**
             * @var SlotegratorConfig $slotegratorConfig
             */
            $slotegratorConfig = $container->get(SlotegratorConfig::class);

            $dbParams = $slotegratorConfig->get('database');

            $connection = DriverManager::getConnection($dbParams);

            $configuration = new Configuration();

            $configuration->addMigrationsDirectory('Slotegrator\Migrations', BASE_DIR . '/src/Migrations');
            $configuration->setAllOrNothing(true);
            $configuration->setCheckDatabasePlatform(false);

            $storageConfiguration = new TableMetadataStorageConfiguration();
            $storageConfiguration->setTableName('doctrine_migration_versions');

            $configuration->setMetadataStorageConfiguration($storageConfiguration);

            return DependencyFactory::fromConnection(
                new ExistingConfiguration($configuration),
                new ExistingConnection($connection)
            );
        });

        return $container;
    }
}
