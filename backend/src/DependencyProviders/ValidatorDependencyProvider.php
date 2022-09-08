<?php declare(strict_types=1);

namespace Slotegrator\DependencyProviders;

use League\Container\Container;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param Container $container
     * @return Container
     */
    public function boot(Container $container): Container
    {
        $container->add(ValidatorInterface::class, function () {
            return Validation::createValidatorBuilder()
                ->enableAnnotationMapping()
                ->getValidator();
        });
        return $container;
    }
}
