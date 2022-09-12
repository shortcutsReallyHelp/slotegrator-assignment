<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use League\Config\Configuration;
use League\Container\Container;
use Slotegrator\Business\Auth\AuthService;
use Slotegrator\Business\Auth\AuthServiceInterface;
use Slotegrator\Business\Auth\TokenIssuer\TokenIssuer;
use Slotegrator\Business\Auth\TokenIssuer\TokenIssuerInterface;
use Slotegrator\Business\Auth\UserReader\UserReader;
use Slotegrator\Business\Auth\UserReader\UserReaderInterface;
use Slotegrator\Business\JWT\JwtServiceInterface;
use Slotegrator\Business\Password\PasswordServiceInterface;
use Slotegrator\Business\User\UserServiceInterface;

class AuthServiceDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(AuthServiceInterface::class, function () use ($container) {
            return new AuthService(
                $container->get(TokenIssuerInterface::class),
                $container->get(UserReaderInterface::class)
            );
        });
        $container->add(TokenIssuerInterface::class, function () use ($container) {
            /** @var Configuration $config */
            $config = $container->get(Configuration::class);

            return new TokenIssuer(
                $container->get(JwtServiceInterface::class),
                $container->get(UserServiceInterface::class),
                $container->get(PasswordServiceInterface::class),
                $config->get('application.token_lifetime')
            );
        });
        $container->add(UserReaderInterface::class, function () use ($container) {
            return new UserReader(
                $container->get(UserServiceInterface::class),
                $container->get(JwtServiceInterface::class)
            );
        });
        return $container;
    }
}
