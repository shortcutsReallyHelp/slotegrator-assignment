<?php declare(strict_types=1);

use Nette\Schema\Expect;

$structure = [
    'driver' => Expect::string()->required(),
    'paths' => Expect::arrayOf('string')->required(),
    'isDevMode' => Expect::bool()->required(),
    'proxyDir' => Expect::string()->required(),
    'proxyNamespace' => Expect::string()->required(),
    'autoGenerateProxyClasses' => Expect::bool()->required(),
    'url' => Expect::string()->required(),
];

return [
    'database' => [
        'structure' => Expect::structure($structure),
        'values' => [
            'driver' => 'pdo_mysql',
            'paths' => [
                 'backend/src/Infrastructure/Entities',
            ],
            'isDevMode' => (bool)((int)$_ENV['DOCTRINE_IS_DEV_MODE']),
            'proxyDir' => $_ENV['DOCTRINE_PROXY_DIR'],
            'proxyNamespace' => $_ENV['DOCTRINE_PROXY_NAMESPACE'],
            'autoGenerateProxyClasses' => (bool)((int)$_ENV['DOCTRINE_AUTO_GENERATE_PROXY_CLASSES']),
            'url' => $_ENV['DOCTRINE_DB_URL'],
        ],
    ],
];
