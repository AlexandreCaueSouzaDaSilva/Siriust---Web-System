<?php

namespace Application\Services;

class PacienteService {

    public function getAllPacientes() {
        // Lógica para obter todos os pacientes
        return [
            ['id' => 1, 'nome' => 'João Silva', 'idade' => 30],
            ['id' => 2, 'nome' => 'Maria Oliveira', 'idade' => 25],
            // ... outros pacientes
        ];
    }
}