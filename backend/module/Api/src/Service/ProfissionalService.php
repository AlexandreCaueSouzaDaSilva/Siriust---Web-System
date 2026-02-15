<?php

namespace Api\Services;

use Doctrine\ORM\EntityManagerInterface;
use Api\Entity\Profissional;

class ProfissionalService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Retorna todos os profissionais ativos
    public function getAllProfissionais(): array
    {
        return $this->em->getRepository(Profissional::class)->findBy(['ativo' => true]);
    }

    // Busca profissional por email
    public function buscarPorEmail(string $email): ?Profissional
    {
        return $this->em->getRepository(Profissional::class)
                        ->findOneBy(['email' => strtolower($email), 'ativo' => true]);
    }

    // Busca profissional por CRM
    public function buscarPorCrm(string $crm): ?Profissional
    {
        $crm = strtoupper(trim($crm));
        return $this->em->getRepository(Profissional::class)
                        ->findOneBy(['crm' => $crm, 'ativo' => true]);
    }

    // Busca profissionais por especialidade
    public function buscarPorEspecialidade(string $especialidade): array
    {
        return $this->em->getRepository(Profissional::class)
                        ->findBy(['especialidade' => $especialidade, 'ativo' => true]);
    }

    // Cadastra novo profissional
    public function cadastrar(Profissional $profissional): ?Profissional
    {
        $existe = $this->buscarPorCrm($profissional->getCrm());
        if ($existe) {
            return null; // já existe profissional com esse CRM
        }

        $this->em->persist($profissional);
        $this->em->flush();

        return $profissional;
    }

    // Atualiza dados de profissional existente
    public function atualizar(Profissional $profissional): Profissional
    {
        $this->em->flush();
        return $profissional;
    }

    // Remove profissional (soft delete)
    public function remover(Profissional $profissional): void
    {
        $profissional->setAtivo(false);
        $this->em->flush();
    }
}