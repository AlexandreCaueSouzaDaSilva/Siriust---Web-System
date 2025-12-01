<?php

// Codigo completo do AuthController.php
namespace Api\Controller;

use Application\Services\UsuarioService; // usado para autenticação
use Domain\Entity\Usuario; // Entidade Usuário




class AuthController
{
    private UsuarioService $usuarioService; // classe de serviço para autenticação


    public function __construct(UsuarioService $usuarioService) // parametro de serviço
    {
        $this->usuarioService = $usuarioService; // atribui

        // Toda resposta desse controller será JSON - Aqui é o cabeçalho HTTP pra linkar lá no front
        header("Content-Type: application/json; charset=UTF-8");
        session_start();
    }

    // POST API LOGIN
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode([
                "status" => "erro",
                "mensagem" => "Método não permitido."
            ]);
            return;
        }

        // Para formulário HTML, os dados estão em $_POST
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $usuario = $this->usuarioService->auth($email, $senha);

        // Se o login falhar (usuário nulo)
        if (!$usuario) {
            http_response_code(401);
            echo json_encode([
                "status" => "erro",
                "mensagem" => "Login flopou: credenciais inválidas."
            ]);
            return;
        }

        // Login OK -> salva sessão
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = [
            'email' => $usuario->getEmail(),
            'nome'  => $usuario->getNome(),
            'role'  => $usuario->getTipo(),
        ];

        // Retorna JSON pro front decidir o que fazer
        echo json_encode([
            "status" => "ok",
            "usuario" => [
                "email" => $usuario->getEmail(),
                "nome"  => $usuario->getNome(),
                "role"  => $usuario->getTipo(),
            ]
        ]);
    }

    // POST /api/registrar
    public function registrar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode([
                "status" => "erro",
                "mensagem" => "Método não permitido."
            ]);
            return;
        }

        // Para formulário HTML, os dados estão em $_POST
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $tipo = $_POST['tipo'] ?? 'paciente';

        if (empty($nome) || empty($email) || empty($senha)) {
            http_response_code(400);
            echo json_encode([
                "status" => "erro",
                "mensagem" => "Nome, email e senha são obrigatórios. Tá tudo vazio"
            ]);
            return;
        }

        $usuario = new Usuario($nome, $email, $senha, $tipo);

        $resultado = $this->usuarioService->cadastrar($usuario);

        if ($resultado) {
            http_response_code(201);
            echo json_encode([
                "status" => "ok",
                "mensagem" => "Usuário cadastrado com sucesso."
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                "status" => "erro", 
                "mensagem" => "Erro ao cadastrar usuário ou email já existe."
            ]);
        }
    }

    // GET /api/usuario atual
    public function usuarioAtual(): void
    {
        if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
            http_response_code(401);
            echo json_encode([
                "status" => "erro",
                "mensagem" => "Não autenticado."
            ]);
            return;
        }

        echo json_encode([
            "status" => "ok",
            "usuario" => $_SESSION['usuario']
        ]);
    }

    // GET /api/logout
    public function logout(): void
    {
        session_destroy();

        echo json_encode([
            "status" => "ok",
            "mensagem" => "Logout feito"
        ]);
    }
}

