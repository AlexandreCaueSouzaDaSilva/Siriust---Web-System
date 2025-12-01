<?php
/**
 * ARQUIVO: module/Api/src/Module.php
 * 
 * FUNÇÃO: Este é o "CORAÇÃO" do módulo Api.
 * O Laminas Framework lê este arquivo para saber:
 * - Onde estão as configurações do módulo
 * - Como fazer autoload das classes
 * 
 * É OBRIGATÓRIO ter este arquivo para o módulo funcionar!
 */

namespace Api; // Namespace DEVE ser igual ao nome da pasta (Api)

class Module
{
    /**
     * Retorna as configurações do módulo
     * 
     * O Laminas chama este método automaticamente ao carregar o módulo.
     * Ele espera receber um array com as configurações (rotas, controllers, etc).
     * 
     * @return array Configurações do módulo
     */
    public function getConfig()
    {
        // Carrega o arquivo module.config.php e retorna seu conteúdo
        // __DIR__ = caminho da pasta atual (module/Api/src)
        // /../config/module.config.php = sobe uma pasta e entra em config
        return include __DIR__ . '/../config/module.config.php';
    }
}