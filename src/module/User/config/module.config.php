<?php

use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session;
use Laminas\Router\Http\Literal;
use User\Controller\UserProfileController;
use User\Controller\UserProfileControllerFactory;
use User\Service\UserService;
use User\Service\UserServiceFactory;

return [
    'router' => [
        'routes' => [
            'profile' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/profile',
                    'defaults' => [
                        'controller' => UserProfileController::class,
                        'action' => 'index',
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'edit' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/edit',
                            'defaults' => [
                                'action' => 'edit',
                            ]
                        ]
                    ],
                ]
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
            UserProfileController::class => UserProfileControllerFactory::class
        ]
    ],

    'service_manager' => [
        'factories' => [
            UserService::class => UserServiceFactory::class,
            AuthenticationService::class => function ($container) {
                $storage = new Session('Auth');
                return new AuthenticationService($storage);
            }
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
