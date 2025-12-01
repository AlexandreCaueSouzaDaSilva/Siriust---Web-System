<?php
// Arquivo: backend/cli-config.php - Código Corrigido e Final

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . '/vendor/autoload.php';

// Esta função será chamada pelo binário do Doctrine
$getEntityManager = static function (): EntityManager {
    
    // CORREÇÃO ESSENCIAL: Definir $ds (DIRECTORY_SEPARATOR) DENTRO da função
    $ds = DIRECTORY_SEPARATOR;

    // 1. CAMINHO FÍSICO CORRETO: module/Api/src/Entity
    // O $ds garante que o caminho seja construído corretamente no Windows.
    $paths = [__DIR__ . $ds . 'module' . $ds . 'Api' . $ds . 'src' . $ds . 'Entity']; 
    $isDevMode = true;

    // 2. PARÂMETROS DE CONEXÃO
    $dbParams = [
        'driver'    => 'pdo_mysql',
        'host'      => '127.0.0.1',
        'port'      => 3306,
        'user'      => 'root',
        'password'  => '',
        'dbname'    => 'clinica',
        'charset'   => 'utf8mb4',
    ];

    // 3. CONFIGURAÇÃO
    $config = Setup::createAttributeMetadataConfiguration($paths, $isDevMode);

    return EntityManager::create($dbParams, $config);
};

// Retorna o HelperSet para o CLI
return ConsoleRunner::createHelperSet($getEntityManager());