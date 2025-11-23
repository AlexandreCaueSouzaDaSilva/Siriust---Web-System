
<?php

use Domain\Entity\Paciente\Paciente;
use Application\Services\PacienteService;


// Aqui usei para testar a leitura do JSON de pacientes inicialmente pelo terminal PHP

$jsonData = file_get_contents(__DIR__ . '/Pacientes.json');
$pacientes = json_decode($jsonData, true);


if ($pacientes === null) {
    echo "Erro ao decodificar JSON!";
} else {
    echo "JSON lido com sucesso! Encontrados " . count($pacientes) . " pacientes.\n";
    print_r($pacientes);
}