<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use League\Config\Configuration;
use League\Container\Container;

class ConfigDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(Configuration::class, function () use ($container) {
            $configFiles = glob(BASE_DIR . '/config/*.php');

            $configs = array_merge(...array_map(function ($file) {
                return require $file;
            }, $configFiles));

            $structures = [];
            foreach ($configs as $configName => $config) {
                $structures[$configName] = $config['structure'];
            }

            $configuration = new Configuration($structures);

            $values = [];
            foreach ($configs as $configName => $config) {
                $values[$configName] = $config['values'];
            }

            $configuration->merge($values);
            return $configuration;
        });

        return $container;
    }
}
