<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use League\Config\Configuration;
use League\Container\Container;
use Slotegrator\Application\I18n\I18n;
use Slotegrator\Application\JWT\JWTService;
use Slotegrator\Application\Password\PasswordService;
use Slotegrator\Business\I18n\I18nInterface;
use Slotegrator\Business\JWT\JwtServiceInterface;
use Slotegrator\Business\Password\PasswordServiceInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ServiceDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(I18nInterface::class, function () use ($container) {
            return new I18n($container->get(TranslatorInterface::class));
        });
        $container->add(PasswordServiceInterface::class, function () use ($container) {
            /** @var Configuration $config */
            $config = $container->get(Configuration::class);
            return new PasswordService($config->get('application.password_secret'));
        });
        $container->add(JwtServiceInterface::class, function () use ($container) {
            /** @var Configuration $config */
            $config = $container->get(Configuration::class);
            return new JwtService(
                $config->get('application.jwt_secret'),
            );
        });
        return $container;
    }
}
