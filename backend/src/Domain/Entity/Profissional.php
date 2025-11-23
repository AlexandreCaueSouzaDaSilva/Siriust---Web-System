<?php

namespace Domain\Entity\Profissional;

class Profissional
{
    private string $nome;
    private int $idade;
    private string $senha;
    private string $data_nasc;
    private string $cpf;
    private string $crm; 

    public function __construct(string $nome, int $idade, string $cpf, string $data_nasc, string $senha, string $crm)
    {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->senha = $senha;
        $this->cpf = $cpf;
        $this->data_nasc = $data_nasc;
        $this->crm = $crm;
    }

    // Getters
    public function getNome(): string
    {
        return $this->nome;
    }

    public function getIdade(): int
    {
        return $this->idade;
    }
    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getDataNasc(): string
    {
        return $this->data_nasc;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }
    public function getCrm(): string
    {
        return $this->crm;
    }
}
