<?php
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                  'driver'   => 'pdo_mysql',
                'host'     => '127.0.0.1',   // pode usar localhost também
                'port'     => 3306,
                'user'     => 'root',
                'password' => 'Super8677', 
                'dbname'   => 'clinica',     // nome do banco
                'charset'  => 'utf8mb4',

            ],
        ],

        'driver' => [
            'orm_default' => [
                // Se estiver usando PHP 8 com atributos #[ORM], usar AttributeDriver, se nao AnnotationDriver
                'class' => Doctrine\ORM\Mapping\Driver\AttributeDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Domain/Entity', // caminho para as entidades
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