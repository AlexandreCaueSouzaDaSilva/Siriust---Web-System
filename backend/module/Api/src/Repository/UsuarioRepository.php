<?php

namespace Api\Repository;

use Api\Entity\Usuario;
use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository
{
    /**
     * Busca usuário por email (case insensitive).
     */
    public function findByEmail(string $email): ?Usuario
    {
        return $this->createQueryBuilder('u')
            ->where('LOWER(u.email) = LOWER(:email)')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Lista todos os usuários ativos.
     */
    public function findAllAtivos(): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.ativo = true')
            ->orderBy('u.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Busca usuários por tipo (paciente, profissional, admin).
     */
    public function findByTipo(string $tipo): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.tipo = :tipo')
            ->setParameter('tipo', $tipo)
            ->orderBy('u.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Verifica se já existe usuário com determinado email.
     */
    public function emailExiste(string $email): bool
    {
        $count = $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->where('LOWER(u.email) = LOWER(:email)')
            ->setParameter('email', $email)
            ->getQuery()
            ->getSingleScalarResult();

        return (int)$count > 0;
    }
}