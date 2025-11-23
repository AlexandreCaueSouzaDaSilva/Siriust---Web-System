<?php

namespace Domain\Entity;

class Usuario {
    private $id; // id para identificação única
    private $nome;
    private $email;
    private $senha;
    private $tipo; // 'paciente' ou 'profissional'
    private $ativo;

    public function __construct($id = null, $nome = '', $email = '', $senha = '', $tipo = 'paciente') {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipo = $tipo;
        $this->ativo = true;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function isAtivo() {
        return $this->ativo;
    }

    // Setters
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    // Verificar senha
    public function verificarSenha($senha) {
        return password_verify($senha, $this->senha);
    }

    // Converter para array (útil para salvar em JSON)
    public function toArray() {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
            'tipo' => $this->tipo,
            'ativo' => $this->ativo
        ];
    }

    // Aqui é para criar um Usuario a partir de um array
    public static function fromArray($data) {
        $usuario = new Usuario();
        $usuario->id = $data['id'] ?? null;
        $usuario->nome = $data['nome'] ?? '';
        $usuario->email = $data['email'] ?? '';
        $usuario->senha = $data['senha'] ?? '';
        $usuario->tipo = $data['tipo'] ?? 'paciente';
        $usuario->ativo = $data['ativo'] ?? true;
        return $usuario;
    }
}
?>