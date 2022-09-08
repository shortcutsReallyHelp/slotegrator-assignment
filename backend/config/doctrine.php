<?php declare(strict_types=1);

use Nette\Schema\Expect;

$structure = [
    'driver' => Expect::string()->required(),
    'paths' => Expect::arrayOf('string')->required(),
    'isDevMode' => Expect::bool()->required(),
    'proxyDir' => Expect::string()->required(),
    'proxyNamespace' => Expect::string()->required(),
    'autoGenerateProxyClasses' => Expect::bool()->required(),
    'dbParams' => Expect::arrayOf('string')->required(),
];

return [
    'database' => [
        'structure' => Expect::structure($structure),
        'values' => [
            'driver' => 'pdo_mysql',
            'paths' => json_decode($_ENV['DOCTRINE_PATHS']),
            'isDevMode' => (bool)((int)$_ENV['DOCTRINE_IS_DEV_MODE']),
            'proxyDir' => $_ENV['DOCTRINE_PROXY_DIR'],
            'proxyNamespace' => $_ENV['DOCTRINE_PROXY_NAMESPACE'],
            'autoGenerateProxyClasses' => (bool)((int)$_ENV['DOCTRINE_AUTO_GENERATE_PROXY_CLASSES']),
            'dbParams' => json_decode($_ENV['DOCTRINE_DB_PARAMS']),
        ],
    ],
];
