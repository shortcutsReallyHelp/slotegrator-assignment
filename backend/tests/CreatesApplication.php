<?php declare(strict_types=1);

namespace Tests;

use League\Container\Container;
use Slotegrator\Console\Starter;

trait CreatesApplication
{
    private ?Container $container = null;

    /**
     * Creates the application.
     *
     * @return Container
     */
    public function createApplication(): Container
    {
        $container = require __DIR__ . '/bootstrap.php';

        if (is_bool($container)) {
            return $this->container;
        }

        return $container;
    }
}
