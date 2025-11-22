<?php
// isso é para o módulo Application
declare(strict_types=1); // deixa o PHP mais rigoroso com os tipos de dados (pelo que entendi)

namespace Application; // namespace só

class Module // class
{
    public function getConfig(): array // aqui vai carregar as configurações
    {
        /** @var array $config */ // aqui é só um comentário para ajudar o IDE
        $config = include __DIR__ . 'Api/config/module.config.php'; // inclui o arquivo de configuração
        return $config; // retorna a configuração
    }
}
