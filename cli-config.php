<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once __DIR__ . '/vendor/autoload.php';

$paths = [__DIR__ . '/backend/src/Domain/Entity'];
$isDevMode = true;

$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'port'     => 3306,
    'user'     => 'root',
    'password' => 'Super8677', //Senha que criei para o banco de dados
    'dbname'   => 'clinica',
    'charset'  => 'utf8mb4',
];

// Se estiver usando atributos (PHP 8+)
$config = Setup::createAttributeMetadataConfiguration($paths, $isDevMode);

$entityManager = EntityManager::create($dbParams, $config);

return ConsoleRunner::createHelperSet($entityManager);