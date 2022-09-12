<?php declare(strict_types=1);

use Nette\Schema\Expect;

$structure = [
    'password_secret' => Expect::string()->required(),
    'jwt_secret' => Expect::string()->required(),
    'token_lifetime' => Expect::int()->required(),
];

return [
    'application' => [
        'structure' => Expect::structure($structure),
        'values' => [
            'password_secret' => $_ENV['PASSWORD_SECRET'],
            'jwt_secret' => $_ENV['JWT_SECRET_KEY'],
            'token_lifetime' => 600
        ],
    ],
];
