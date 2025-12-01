<?php

// Entidade Profissional completa
namespace Domain\Entity;

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

    #[ORM\Column(type: "string", length: 255)]
    private string $crm;

    #[ORM\Column(type: "string", length: 255)]
    private string $especialidade;

    // Getters e setters...
}
