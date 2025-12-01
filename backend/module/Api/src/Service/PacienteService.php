<?php

namespace Api\Services;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Entity\Paciente;

class PacienteService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Retorna todos os pacientes
    public function getAllPacientes(): array
    {
        return $this->em->getRepository(Paciente::class)->findAll();
    }

    // Busca paciente por CPF
    public function buscarPorCpf(string $cpf): ?Paciente
    {
        return $this->em->getRepository(Paciente::class)
                        ->findOneBy(['cpf' => $cpf]);
    }

    // Cadastra novo paciente
    public function cadastrar(Paciente $paciente): bool
    {
        $existe = $this->buscarPorCpf($paciente->getCpf());
        if ($existe) {
            return false; // já existe paciente com esse CPF
        }

        $this->em->persist($paciente);
        $this->em->flush();
        return true;
    }
}