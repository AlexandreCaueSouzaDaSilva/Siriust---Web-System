<?php

namespace Api\Repository;

use Api\Entity\Paciente;
use Doctrine\ORM\EntityRepository;

class PacienteRepository extends EntityRepository
{
    /**
     * Busca paciente por CPF.
     */
    public function findByCpf(string $cpf): ?Paciente
    {
        $cpf = preg_replace('/\D/', '', $cpf); // remove caracteres não numéricos
        return $this->createQueryBuilder('p')
            ->where('p.cpf = :cpf')
            ->setParameter('cpf', $cpf)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Lista todos os pacientes ativos.
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
     * Busca pacientes por nome (parcial, case insensitive).
     */
    public function findByNome(string $nome): array
    {
        return $this->createQueryBuilder('p')
            ->where('LOWER(p.nome) LIKE LOWER(:nome)')
            ->setParameter('nome', '%' . $nome . '%')
            ->orderBy('p.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Verifica se já existe paciente com determinado CPF.
     */
    public function cpfExiste(string $cpf): bool
    {
        $cpf = preg_replace('/\D/', '', $cpf);
        $count = $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->where('p.cpf = :cpf')
            ->setParameter('cpf', $cpf)
            ->getQuery()
            ->getSingleScalarResult();

        return (int)$count > 0;
    }
}