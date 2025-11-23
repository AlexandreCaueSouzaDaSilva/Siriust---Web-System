<?php

namespace Application\Services;


// Importa a entidade Paciente
use Domain\Entity\Paciente\Paciente;


class PacienteService {
   
private string $jsonFile; // Caminho para o arquivo JSON

    public function __construct(string $jsonFile = 'pacientes.json')
    {
        $this->jsonFile = $jsonFile;
    }

// Método para obter todos os pacientes
    public function getAllPacientes(): array
    {
        if (!file_exists($this->jsonFile)) {
            return [];
        }

        // pega o conteudo do JSON e lê
        $jsonData = file_get_contents($this->jsonFile);
        $pacientesData = json_decode($jsonData, true);

 
        $pacientes = [];  
        // Litsa os dados e cria objetos Paciente + mais facil de manipular
        foreach ($pacientesData as $data) {
            $pacientes[] = new Paciente(
                $data['nome'],
                $data['idade'],
                $data['cpf'],
                $data['data_nasc']
            );
        }

        return $pacientes;
    }

// Busca paciente por CPF
    public function buscarPorCpf(string $cpf): ?Paciente // Paciente ou null
    {
        $pacientes = $this->getAllPacientes();

        foreach ($pacientes as $paciente) {
            if ($paciente->getCpf() === $cpf) {
                return $paciente;
            }
        }
        // Porque preciso saber se não encontrou um paciente com esse CPF
        return null;
    }
}


