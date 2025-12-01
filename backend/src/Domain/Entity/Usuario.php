<?php

// Entidade Usuario completa
namespace Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "usuario")]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $nome;

    #[ORM\Column(type: "string", length: 255, unique: true)]
    private string $email;

    #[ORM\Column(type: "string", length: 255)]
    private string $senha;

    #[ORM\Column(type: "string", length: 50)]
    private string $tipo = 'paciente'; // paciente ou profissional

    #[ORM\Column(type: "boolean")]
    private bool $ativo = true;

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getEmail(): string { return $this->email; }
    public function getSenha(): string { return $this->senha; }
    public function getTipo(): string { return $this->tipo; }
    public function isAtivo(): bool { return $this->ativo; }

    // Setters
    public function setNome(string $nome): void { $this->nome = $nome; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setSenha(string $senha): void { $this->senha = $senha; }
    public function setTipo(string $tipo): void { $this->tipo = $tipo; }
    public function setAtivo(bool $ativo): void { $this->ativo = $ativo; }

    // Verificar senha (mantém a lógica de hash/verify) - usada na autenticação
    public function verificarSenha(string $senha): bool {
        return password_verify($senha, $this->senha);
    }
}