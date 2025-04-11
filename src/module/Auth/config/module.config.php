<?php

use Auth\Controller\AuthController;
use Auth\Controller\AuthControllerFactory;
use Auth\Service\AuthService;
use Auth\Service\AuthServiceFactory;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session;

return [
    'controllers' => [
        'factories' => [
            AuthController::class => AuthControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            AuthService::class => AuthServiceFactory::class,

            AuthenticationService::class => function ($container) {
                $storage = new Session('Auth');
                return new AuthenticationService($storage);
            }
        ],
    ],
    'router' => [
        'routes' => [
            'register' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/register',
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action' => 'register',
                    ],
                ],
            ],
            'login' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action' => 'login',
                    ],
                ],
            ],
            'logout' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/logout',
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action' => 'logout',
                    ]
                ]
            ]
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
