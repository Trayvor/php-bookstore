<?php

use Doctrine\DBAL\Driver\PDO\MySQL\Driver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => Driver::class,
                'params' => [
                    'host'     => 'db',
                    'port'     => 3306,
                    'user'     => 'root',
                    'password' => 'rootpass',
                    'dbname'   => 'bookstore',
                    'charset'  => 'utf8mb4',
                ],
            ],
        ],
        'configuration' => [
            'orm_default' => [
                'datetime_functions' => [],
                'numeric_functions' => [],
                'string_functions' => [],
            ],
        ],
        'driver' => [
            'user_entities' => [
                'class' => Doctrine\ORM\Mapping\Driver\AttributeDriver::class,
                'cache' => 'array',
                'paths' => ['/var/www/html/module/User/src/Entity'],
            ],
            'orm_default' => [
                'drivers' => [
                    'User\Entity' => 'user_entities',
                ],
            ],
        ],
    ],
];
