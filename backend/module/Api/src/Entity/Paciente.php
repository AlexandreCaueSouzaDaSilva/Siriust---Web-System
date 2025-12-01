<?php

// Entidade Paciente completa
namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "paciente")]
class Paciente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $nome;

    #[ORM\Column(type: "integer")]
    private int $idade;

    #[ORM\Column(type: "string", length: 11, unique: true)]
    private string $cpf;

    #[ORM\Column(type: "date")]
    private \DateTime $dataNasc;

    // Getters e setters
    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function setNome(string $nome): void { $this->nome = $nome; }

    public function getIdade(): int { return $this->idade; }
    public function setIdade(int $idade): void { $this->idade = $idade; }

    public function getCpf(): string { return $this->cpf; }
    public function setCpf(string $cpf): void { $this->cpf = $cpf; }

    public function getDataNasc(): \DateTime { return $this->dataNasc; }
    public function setDataNasc(\DateTime $dataNasc): void { $this->dataNasc = $dataNasc; }
}