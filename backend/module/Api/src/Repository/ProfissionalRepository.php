<?php

namespace Api\Repository;

use Api\Entity\Profissional;
use Doctrine\ORM\EntityRepository;

class ProfissionalRepository extends EntityRepository
{
    /**
     * Busca profissional por email (case insensitive).
     */
    public function findByEmail(string $email): ?Profissional
    {
        return $this->createQueryBuilder('p')
            ->where('LOWER(p.email) = LOWER(:email)')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Busca profissional por CRM.
     */
    public function findByCrm(string $crm): ?Profissional
    {
        return $this->createQueryBuilder('p')
            ->where('p.crm = :crm')
            ->setParameter('crm', strtoupper($crm))
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Lista todos os profissionais ativos.
     */
    public function findAllAtivos(): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.ativo = true')
            ->orderBy('p.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Busca profissionais por especialidade.
     */
    public function findByEspecialidade(string $especialidade): array
    {
        return $this->createQueryBuilder('p')
            ->where('LOWER(p.especialidade) = LOWER(:esp)')
            ->setParameter('esp', $especialidade)
            ->orderBy('p.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Verifica se já existe profissional com determinado CRM.
     */
    public function crmExiste(string $crm): bool
    {
        $count = $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->where('p.crm = :crm')
            ->setParameter('crm', strtoupper($crm))
            ->getQuery()
            ->getSingleScalarResult();

        return (int)$count > 0;
    }
}