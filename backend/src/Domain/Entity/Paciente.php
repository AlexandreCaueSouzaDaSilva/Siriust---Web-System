<?php

namespace Domain\Entity;

class Paciente
{
    private int $id;
    private string $nome;
    private int $idade;

    public function __construct( string $nome, int $idade)
    {
        $this->id = 
        $this->nome = $nome;
        $this->idade = $idade;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getIdade(): int
    {
        return $this->idade;
    }
}