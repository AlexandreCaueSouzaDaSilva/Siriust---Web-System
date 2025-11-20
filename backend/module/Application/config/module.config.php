<?php

namespace Application;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'api-teste' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/api/teste',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action' => 'teste',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\ApiController::class => InvokableFactory::class,
        ],
    ],
];