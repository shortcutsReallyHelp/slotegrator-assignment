<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\ExistingConfiguration;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Metadata\Storage\TableMetadataStorageConfiguration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use League\Config\Configuration;
use League\Container\Container;

class DoctrineDependencyProvider implements DependencyProviderInterface
{
    public const DOCTRINE_DEPENDENCY_FACTORY = 'doctrine_dependency_factory';

    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(EntityManager::class, function () use ($container) {
            /**
             * @var Configuration $configuration
             */
            $configuration = $container->get(Configuration::class);

            $config = ORMSetup::createAttributeMetadataConfiguration(
                $configuration->get('database.paths'),
                $configuration->get('database.isDevMode'),
            );
            $config->setProxyDir($configuration->get('database.proxyDir'));
            $config->setProxyNamespace($configuration->get('database.proxyNamespace'));
            $config->setAutoGenerateProxyClasses($configuration->get('database.autoGenerateProxyClasses'));

            return EntityManager::create($configuration->get('database'), $config);
        });

        $container->add(self::DOCTRINE_DEPENDENCY_FACTORY, function () use ($container) {
            $configuration = new \Doctrine\Migrations\Configuration\Configuration();

            $configuration->addMigrationsDirectory('Slotegrator\Migrations', BASE_DIR . '/src/Migrations');

            $storageConfiguration = new TableMetadataStorageConfiguration();
            $storageConfiguration->setTableName('doctrine_migration_versions');

            $configuration->setMetadataStorageConfiguration($storageConfiguration);

            return DependencyFactory::fromEntityManager(
                new ExistingConfiguration($configuration),
                new ExistingEntityManager($container->get(EntityManager::class)),
            );
        });

        return $container;
    }
}
