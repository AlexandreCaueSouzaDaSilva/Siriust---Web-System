<?php

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

    #[ORM\Column(type: "string", length: 11, unique: true)]
    private string $cpf;

    #[ORM\Column(type: "date")]
    private \DateTimeImmutable $dataNasc;

    #[ORM\Column(type: "boolean")]
    private bool $ativo = true;

    public function __construct(string $nome, string $cpf, \DateTimeImmutable $dataNasc)
    {
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setDataNasc($dataNasc);
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getCpf(): string { return $this->cpf; }
    public function getDataNasc(): \DateTimeImmutable { return $this->dataNasc; }
    public function isAtivo(): bool { return $this->ativo; }

    // Setters
    public function setNome(string $nome): void
    {
        if (empty(trim($nome))) {
            throw new \InvalidArgumentException("Nome não pode ser vazio.");
        }
        $this->nome = $nome;
    }

    public function setCpf(string $cpf): void
    {
        $cpf = preg_replace('/\D/', '', $cpf); // remove caracteres não numéricos
        if (!$this->isValidCpf($cpf)) {
            throw new \InvalidArgumentException("CPF inválido.");
        }
        $this->cpf = $cpf;
    }

    public function setDataNasc(\DateTimeImmutable $dataNasc): void
    {
        $this->dataNasc = $dataNasc;
    }

    public function setAtivo(bool $ativo): void
    {
        $this->ativo = $ativo;
    }

    // Calcula idade dinamicamente
    public function getIdade(): int
    {
        $hoje = new \DateTimeImmutable('today');
        $diff = $hoje->diff($this->dataNasc);
        return $diff->y;
    }

    // Validação de CPF
    private function isValidCpf(string $cpf): bool
    {
        if (strlen($cpf) != 11 || preg_match('/^(\\d)\\1{10}$/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
}