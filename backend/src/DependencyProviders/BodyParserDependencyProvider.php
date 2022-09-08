<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use League\Container\Container;
use Slotegrator\Http\Middlewares\BodyParserMiddleware;

class BodyParserDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(BodyParserMiddleware::class, function () use ($container) {
            return new BodyParserMiddleware();
        });
        return $container;
    }
}
