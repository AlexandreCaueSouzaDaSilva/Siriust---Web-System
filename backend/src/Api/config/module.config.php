<?php

namespace Api\config; // configuração da Api

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Application\Controller\UsuarioController;
use Api\Controller\ProfissionalController;
use Api\Controller\PacienteController;

return [
    'router' => [
        'routes' => [
            'api-usuarios' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/api/usuarios',
                    'defaults' => [
                        'controller' => PacienteController::class,
                        'action'     => 'listar',
                    ],
                ],
            ],
        ],
    ],
];