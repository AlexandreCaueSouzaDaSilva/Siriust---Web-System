<?php
// Arquivo: backend/config/autoload/global.php - Código Final Corrigido

use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\DBAL\Driver\PDO\MySQL\Driver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => Driver::class,
                // Os parâmetros de conexão são herdados do local.php
            ],
        ],

        'driver' => [
            // 1. Definição do Driver Específico para o Módulo API
            'api_entity_driver' => [ 
                'class' => AttributeDriver::class,
                'cache' => 'array',
                // Caminho físico correto: ../../module/Api/src/Entity
                'paths' => [ __DIR__ . '/../../module/Api/src/Entity' ], 
            ],
            
            'orm_default' => [
                'drivers' => [
                    // 2. Associa o namespace de código 'Api\Entity' ao driver
                    'Api\Entity' => 'api_entity_driver', 
                ],
            ],
        ],
        
        'configuration' => [
            'orm_default' => [
                'proxy_dir' => __DIR__ . '/../../data/DoctrineORMModule/Proxy',
                'proxy_namespace' => 'DoctrineORMModule\Proxy',
                'generate_proxies' => true,
            ],
        ],
    ],
];