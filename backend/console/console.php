#!/usr/bin/env php
<?php declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

const BASE_DIR = __DIR__ . '/..';


use Slotegrator\Console\Starter;
use Slotegrator\DependencyProviders\ConsoleDependencyProvider;
use Symfony\Component\Console\Application;


$starter = new Starter();
$container = $starter();

$application = new Application();
$application->addCommands($container->get(ConsoleDependencyProvider::COMMANDS));

$application->run();
