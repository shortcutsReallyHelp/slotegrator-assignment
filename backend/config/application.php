<?php

declare(strict_types=1);

use Nette\Schema\Expect;

$structure = [
    'password_secret' => Expect::string()->required(),
    'jwt_secret' => Expect::string()->required(),
    'token_lifetime' => Expect::int()->required(),
    'raffle_bonus_max' => Expect::int()->required(),
    'raffle_bonus_min' => Expect::int()->required(),
    'raffle_money_max' => Expect::int()->required(),
    'raffle_money_min' => Expect::int()->required(),
];

return [
    'application' => [
        'structure' => Expect::structure($structure),
        'values' => [
            'password_secret' => $_ENV['PASSWORD_SECRET'],
            'jwt_secret' => $_ENV['JWT_SECRET_KEY'],
            'token_lifetime' => 60 * 24 * 1000,
            'raffle_bonus_max' => 1000,
            'raffle_bonus_min' => 10,
            'raffle_money_max' => 1000,
            'raffle_money_min' => 10,
        ],
    ],
];
