<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use League\Container\Container;
use Slotegrator\Application\Raffle\CommandHandler\PlayCommandHandler;
use Slotegrator\Application\Raffle\CommandHandler\PlayCommandHandlerInterface;
use Slotegrator\Application\SignIn\CommandHandler\SignInCommandHandlerInterface;
use Slotegrator\Application\SignUp\CommandHandler\SignUpCommandHandlerInterface;
use Slotegrator\Http\Controllers\RaffleController;
use Slotegrator\Http\Controllers\SignInController;
use Slotegrator\Http\Controllers\SignupController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ControllerDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(SignupController::class, function () use ($container) {
            return new SignupController($container->get(SignUpCommandHandlerInterface::class), ...$this->getBasicControllerArguments($container));
        });
        $container->add(SignInController::class, function () use ($container) {
            return new SignInController($container->get(SignInCommandHandlerInterface::class), ...$this->getBasicControllerArguments($container));
        });
        $container->add(RaffleController::class, function () use ($container) {
            return new RaffleController($container->get(PlayCommandHandlerInterface::class), ...$this->getBasicControllerArguments($container));
        });
        return $container;
    }

    /**
     * @param Container $container
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function getBasicControllerArguments(Container $container): array
    {
        return [
            $container,
            $container->get(ValidatorInterface::class),
            $container->get(TranslatorInterface::class),
        ];
    }
}
