<?php

namespace Api\Services;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Entity\Usuario;

// Classe do UsuarioService - responsável pela lógica de autenticação e cadastro de usuários
class UsuarioService
{
    private EntityManagerInterface $em; // em = entity manager

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Função auth - Autentica o usuário email + senha
    public function auth(string $email, string $senha): ?Usuario
    {
        $usuario = $this->em->getRepository(Usuario::class)
                            ->findOneBy(['email' => $email, 'ativo' => true]);

        if (!$usuario) {
            return null;
        }

        if ($usuario->verificarSenha($senha)) {
            return $usuario;
        }

        return null;
    }

    // Função Cadastrar - Cadastro de novo usuário (paciente ou profissional)
    public function cadastrar(Usuario $usuario): bool
    {
        // Verifica se já existe email
        $existe = $this->em->getRepository(Usuario::class)
                           ->findOneBy(['email' => $usuario->getEmail()]);

        if ($existe) {
            return false; // Email já existe
        }

        // Hash da senha antes de salvar
        $usuario->setSenha(password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
 
        $this->em->persist($usuario); // Prepara para salvar ( Manda pro Banco quando der flush )
        $this->em->flush(); // Aqui  o Flush é quem salva de fato no banco

        return true; // Cadastro OK
    }
}