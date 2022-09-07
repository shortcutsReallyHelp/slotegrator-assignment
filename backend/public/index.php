<?php declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Slotegrator\Http\Starter;

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST
);

$starter = new Starter();
$container = $starter();

/**
 * @var \League\Route\Router $router
 */
$router = $container->get(Starter::ROUTER);
$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
