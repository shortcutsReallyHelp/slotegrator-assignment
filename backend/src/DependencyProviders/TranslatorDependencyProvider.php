<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use League\Container\Container;
use Symfony\Component\Translation\Loader\PhpFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Contracts\Translation\TranslatorInterface;

class TranslatorDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(TranslatorInterface::class, function () {
            $translator = new Translator('en');
            $translator->addLoader('php', new PhpFileLoader());
            $translator->addResource('php', BASE_DIR . '/config/translations/en.php', 'en');
            return $translator;
        });
        return $container;
    }
}
