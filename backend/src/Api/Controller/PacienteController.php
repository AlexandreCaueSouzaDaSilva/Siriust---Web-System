<?php

namespace Api\Controller;

class PacienteController
{   // Atributos
    private $criarusuario;
    private $service;

    //Construtor$usercreated)
    public function __construct($criarusuario, $service)
    {
        $this->criarusuario = $criarusuario;
        $this->service = $service;
    }
    //Método para criar paciente
    public function GetAll()
    {
     return $this->service->getAllPacientes();
    }
}
