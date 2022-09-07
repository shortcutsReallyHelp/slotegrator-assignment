<?php declare(strict_types=1);

namespace Slotegrator\Http\Routes;

use League\Container\Container;
use League\Route\Router;

interface RoutesProviderInterface
{
    /**
     * @param Router $router
     * @param Container $container
     * @return Router
     */
    public function boot(Router $router, Container $container): Router;
}
