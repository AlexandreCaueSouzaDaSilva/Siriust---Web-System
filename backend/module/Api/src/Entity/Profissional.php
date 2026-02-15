<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "profissional")]
class Profissional
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $nome;

    #[ORM\Column(type: "string", length: 255, unique: true)]
    private string $email;

    #[ORM\Column(type: "string", length: 20, unique: true)]
    private string $crm;

    #[ORM\Column(type: "string", length: 100)]
    private string $especialidade;

    #[ORM\Column(type: "boolean")]
    private bool $ativo = true;

    public function __construct(string $nome, string $email, string $crm, string $especialidade)
    {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setCrm($crm);
        $this->setEspecialidade($especialidade);
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getEmail(): string { return $this->email; }
    public function getCrm(): string { return $this->crm; }
    public function getEspecialidade(): string { return $this->especialidade; }
    public function isAtivo(): bool { return $this->ativo; }

    // Setters com validações
    public function setNome(string $nome): void
    {
        if (empty(trim($nome))) {
            throw new \InvalidArgumentException("Nome não pode ser vazio.");
        }
        $this->nome = $nome;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email inválido.");
        }
        $this->email = $email;
    }

    public function setCrm(string $crm): void
    {
        $crm = strtoupper(trim($crm));
        // Exemplo de validação: 6 dígitos + UF (ex.: 123456PE)
        if (!preg_match('/^\d{6}[A-Z]{2}$/', $crm)) {
            throw new \InvalidArgumentException("CRM inválido. Formato esperado: 6 dígitos + UF.");
        }
        $this->crm = $crm;
    }

    public function setEspecialidade(string $especialidade): void
    {
        if (empty(trim($especialidade))) {
            throw new \InvalidArgumentException("Especialidade não pode ser vazia.");
        }
        $this->especialidade = $especialidade;
    }

    public function setAtivo(bool $ativo): void
    {
        $this->ativo = $ativo;
    }
}