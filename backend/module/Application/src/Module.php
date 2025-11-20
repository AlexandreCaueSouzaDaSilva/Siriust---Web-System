<?php
// isso é para o módulo Application
declare(strict_types=1);

namespace Application; // namespace só

class Module // class
{
    public function getConfig(): array // Vai carregar as configurações
    {
        /** @var array $config */ // tipagem
        $config = include __DIR__ . '/../config/module.config.php'; // inclui o arquivo de configuração da aplicação
        return $config; // retorna a configuração
    }
}
