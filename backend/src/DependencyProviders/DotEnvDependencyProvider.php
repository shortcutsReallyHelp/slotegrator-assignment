<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use Dotenv\Dotenv;
use League\Container\Container;

class DotEnvDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $dotenv = Dotenv::createImmutable(BASE_DIR . '/..');
        $dotenv->load();

        return $container;
    }
}
