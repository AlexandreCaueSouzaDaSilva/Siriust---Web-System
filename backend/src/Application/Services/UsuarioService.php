<?php

namespace Application\Services\UsuarioService;

use Domain\Entity\Usuario;

class UsuarioService
{
    private string $jsonFile;

    public function __construct(string $jsonFile = 'usuarios.json')
    {
        $this->jsonFile = $jsonFile;
    }

    // Autentica o usuário email + senha
    public function auth(string $email, string $senha): ?Usuario
    {
        // Se o JSON não existe retorna nulo por que não tem como autenticar
        if (!file_exists($this->jsonFile)) {
            return null;
        }

        // Lê JSON
        $jsonData = file_get_contents($this->jsonFile);
        $usuariosData = json_decode($jsonData, true);

        // Caso JSON esteja corrompido ou vazio
        if (!is_array($usuariosData)) {
            return null;
        }

        // Procura usuário
        foreach ($usuariosData as $data) {
            // Verifica se o email existe e se o usuário está ativo
            if (
                isset($data['email'], $data['senha']) &&
                $data['email'] === $email &&
                ($data['ativo'] ?? true) === true
            ) {
                // Cria um objeto Usuario a partir dos dados
                $usuario = Usuario::fromArray($data);

                // Verifica a senha com hash
                if ($usuario->verificarSenha($senha)) {
                    return $usuario;
                }
            }
        }

        // login flopou
        return null;
    }

    // Cadastra novo usuário (paciente ou profissional)
    public function cadastrar(Usuario $usuario): bool
    {
        $lista = [];

        // Se já existir JSON, carrega
        if (file_exists($this->jsonFile)) {
            $jsonData = file_get_contents($this->jsonFile);
            $lista = json_decode($jsonData, true) ?: [];
        }

        // Verifica se o email já está cadastrado
        foreach ($lista as $user) {
            if ($user['email'] === $usuario->getEmail()) {
                return false; // Email já existe
            }
        }

        // Adiciona novo user
        $lista[] = $usuario->toArray();

        // Salva de volta
        return file_put_contents(
            $this->jsonFile,
            json_encode($lista, JSON_PRETTY_PRINT)
        ) !== false;
    }
}