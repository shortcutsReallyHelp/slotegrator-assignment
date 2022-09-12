<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use League\Container\Container;
use Slotegrator\Application\SignUp\CommandHandler\SignUpCommandHandler;
use Slotegrator\Application\SignUp\CommandHandler\SignUpCommandHandlerInterface;
use Slotegrator\Business\I18n\I18nInterface;
use Slotegrator\Business\Password\PasswordServiceInterface;
use Slotegrator\Business\User\UserCreator\UserCreator;
use Slotegrator\Business\User\UserCreator\UserCreatorInterface;
use Slotegrator\Business\User\UserEntityManagerInterface;
use Slotegrator\Business\User\UserReader\UserReader;
use Slotegrator\Business\User\UserReader\UserReaderInterface;
use Slotegrator\Business\User\UserRepositoryInterface;
use Slotegrator\Business\User\UserService;
use Slotegrator\Business\User\UserServiceInterface;
use Slotegrator\Infrastructure\EntityManagers\UserEntityManager;
use Slotegrator\Infrastructure\Mapper\User\UserMapper;
use Slotegrator\Infrastructure\Mapper\User\UserMapperInterface;
use Slotegrator\Infrastructure\Repositories\UserRepository;

class UserServiceDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(UserServiceInterface::class, function () use ($container) {
            return new UserService(
                $container->get(UserCreatorInterface::class),
                $container->get(UserReaderInterface::class)
            );
        });
        $container->add(UserRepositoryInterface::class, function () use ($container) {
            return new UserRepository(
                $container->get(EntityManager::class),
                $container->get(UserMapperInterface::class)
            );
        });
        $container->add(UserCreatorInterface::class, function () use ($container) {
            return new UserCreator(
                $container->get(UserReaderInterface::class),
                $container->get(UserEntityManagerInterface::class),
                $container->get(I18nInterface::class),
                $container->get(PasswordServiceInterface::class)
            );
        });
        $container->add(UserReaderInterface::class, function () use ($container) {
            return new UserReader(
                $container->get(UserRepositoryInterface::class)
            );
        });
        $container->add(UserEntityManagerInterface::class, function () use ($container) {
            return new UserEntityManager(
                $container->get(UserMapperInterface::class),
                $container->get(EntityManager::class)
            );
        });
        $container->add(UserMapperInterface::class, function () use ($container) {
            return new UserMapper();
        });
        $container->add(SignUpCommandHandlerInterface::class, function () use ($container) {
            return new SignUpCommandHandler(
                $container->get(UserServiceInterface::class),
                $container->get(I18nInterface::class)
            );
        });

        return $container;
    }
}
