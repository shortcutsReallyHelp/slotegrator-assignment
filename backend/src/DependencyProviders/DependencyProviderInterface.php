<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use League\Container\Container;

interface DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return void
     */
    public function boot(Container $container): Container;
}
