<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use League\Config\Configuration;
use League\Container\Container;

class DoctrineDependencyProvider implements DependencyProviderInterface
{
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

            $config = ORMSetup::createAnnotationMetadataConfiguration(
                $configuration->get('database.paths'),
                $configuration->get('database.isDevMode')
            );
            $config->setProxyDir($configuration->get('database.proxyDir'));
            $config->setProxyNamespace($configuration->get('database.proxyNamespace'));
            $config->setAutoGenerateProxyClasses($configuration->get('database.autoGenerateProxyClasses'));

            return EntityManager::create($configuration->get('database.values.dbParams'), $config);
        });

        return $container;
    }
}
