#!/usr/bin/env php
<?php declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

if (!defined('BASE_DIR')) {
    define('BASE_DIR', __DIR__ . '/..');
}

use Slotegrator\Console\Starter;

$starter = new Starter();
$container = $starter();

return $container;
