<?php

namespace Api\Services;

use Doctrine\ORM\EntityManagerInterface;
use Api\Entity\Usuario;

class UsuarioService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Autentica o usuário pelo email e senha.
     * Retorna o objeto Usuario se válido, ou null se inválido.
     */
    public function auth(string $email, string $senha): ?Usuario
    {
        $usuario = $this->em->getRepository(Usuario::class)
                            ->findOneBy(['email' => strtolower($email), 'ativo' => true]);

        if ($usuario && $usuario->verificarSenha($senha)) {
            return $usuario;
        }

        return null;
    }

    /**
     * Cadastra um novo usuário.
     * Retorna o objeto Usuario se cadastrado com sucesso, ou null se email já existe.
     */
    public function cadastrar(Usuario $usuario): ?Usuario
    {
        $existe = $this->em->getRepository(Usuario::class)
                           ->findOneBy(['email' => strtolower($usuario->getEmail())]);

        if ($existe) {
            return null;
        }

        // Aqui não precisa aplicar password_hash manualmente,
        // pois o setSenha da entidade já faz isso.
        $this->em->persist($usuario);
        $this->em->flush();

        return $usuario;
    }
}