<?php

namespace Api\Services;

use Doctrine\ORM\EntityManagerInterface;
use Api\Entity\Paciente;

class PacienteService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Retorna todos os pacientes ativos
    public function getAllPacientes(): array
    {
        return $this->em->getRepository(Paciente::class)->findBy(['ativo' => true]);
    }

    // Busca paciente por CPF (normalizado)
    public function buscarPorCpf(string $cpf): ?Paciente
    {
        $cpf = preg_replace('/\D/', '', $cpf); // remove caracteres não numéricos
        return $this->em->getRepository(Paciente::class)
                        ->findOneBy(['cpf' => $cpf, 'ativo' => true]);
    }

    // Cadastra novo paciente
    public function cadastrar(Paciente $paciente): ?Paciente
    {
        $cpf = preg_replace('/\D/', '', $paciente->getCpf());
        $existe = $this->buscarPorCpf($cpf);

        if ($existe) {
            return null; // já existe paciente com esse CPF
        }

        $this->em->persist($paciente);
        $this->em->flush();

        return $paciente;
    }

    // Atualiza dados de paciente existente
    public function atualizar(Paciente $paciente): Paciente
    {
        $this->em->flush();
        return $paciente;
    }

    // Remove paciente (soft delete)
    public function remover(Paciente $paciente): void
    {
        $paciente->setAtivo(false);
        $this->em->flush();
    }
}