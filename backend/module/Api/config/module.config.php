<?php

namespace Api\config; // configuração da Api

use Laminas\Router\Http\Segment;
use Api\Controller\UsuarioController;
use Api\Controller\ProfissionalController;
use Api\Controller\PacienteController;

return [
    'router' => [
        'routes' => [
            'api-usuarios' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/api/usuarios[/:id]',
                    'defaults' => [
                        'controller' => UsuarioController::class,
                    ],
                ],
            ],
            'api-pacientes' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/api/pacientes[/:id]',
                    'defaults' => [
                        'controller' => PacienteController::class,
                    ],
                ],
            ],
            'api-profissionais' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/api/profissionais[/:id]',
                    'defaults' => [
                        'controller' => ProfissionalController::class,
                    ],
                ],
            ],
        ],
    ],
];


