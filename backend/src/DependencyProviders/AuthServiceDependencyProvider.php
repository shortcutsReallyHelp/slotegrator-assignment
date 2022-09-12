<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use League\Config\Configuration;
use League\Container\Container;
use Slotegrator\Application\SignIn\CommandHandler\SignInCommandHandler;
use Slotegrator\Application\SignIn\CommandHandler\SignInCommandHandlerInterface;
use Slotegrator\Business\Auth\AuthService;
use Slotegrator\Business\Auth\AuthServiceInterface;
use Slotegrator\Business\Auth\TokenIssuer\TokenIssuer;
use Slotegrator\Business\Auth\TokenIssuer\TokenIssuerInterface;
use Slotegrator\Business\Auth\UserReader\UserReader;
use Slotegrator\Business\Auth\UserReader\UserReaderInterface;
use Slotegrator\Business\I18n\I18nInterface;
use Slotegrator\Business\JWT\JwtServiceInterface;
use Slotegrator\Business\Password\PasswordServiceInterface;
use Slotegrator\Business\User\UserServiceInterface;
use Slotegrator\Http\Middlewares\AuthMiddleware;
use Symfony\Contracts\Translation\TranslatorInterface;

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
        $container->add(SignInCommandHandlerInterface::class, function () use ($container) {
            return new SignInCommandHandler(
                $container->get(AuthServiceInterface::class),
                $container->get(I18nInterface::class)
            );
        });
        $container->add(AuthMiddleware::class, function () use ($container) {
            return new AuthMiddleware(
                $container->get(AuthServiceInterface::class)
            );
        });
        return $container;
    }
}
