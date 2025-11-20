<?php
// Habilita CORS para o frontend poder acessar
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Se for uma requisição OPTIONS, retorna ok para o preflight
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Define o tipo de conteúdo como JSON
header('Content-Type: application/json');

// Obtém a URL requisitada
$request_uri = $_SERVER['REQUEST_URI'];

// Remove a parte da query string, se houver
$path = parse_url($request_uri, PHP_URL_PATH);

// Define as rotas
$routes = [
    '/' => function() {
        return ['message' => 'Backend Siriust funcionando! 🚀'];
    },
    '/api' => function() {
        return ['message' => 'API Root'];
    },
    '/api/usuarios' => function() {
        return [
            ['id' => 1, 'nome' => 'Caue'],
            ['id' => 2, 'nome' => 'Maria']
        ];
    },
    '/api/produtos' => function() {
        return [
            ['id' => 1, 'nome' => 'Produto A', 'preco' => 99.90],
            ['id' => 2, 'nome' => 'Produto B', 'preco' => 149.90]
        ];
    }
];

// Verifica se a rota existe
if (array_key_exists($path, $routes)) {
    $data = $routes[$path]();
    echo json_encode($data);
} else {
    // Rota não encontrada
    http_response_code(404);
    echo json_encode(['error' => 'Rota não encontrada: ' . $path]);
}