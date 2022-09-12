<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use League\Container\Container;
use Slotegrator\Http\Requests\SignInRequest;
use Slotegrator\Http\Requests\SignUpRequest;

class RequestDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(SignUpRequest::class, function () use ($container) {
            return new SignUpRequest();
        });
        $container->add(SignInRequest::class, function () use ($container) {
            return new SignInRequest();
        });
        return $container;
    }
}
