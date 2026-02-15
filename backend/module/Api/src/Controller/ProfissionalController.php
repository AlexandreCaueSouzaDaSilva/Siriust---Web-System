<?php

namespace Api\Controller;

use Api\Entity\Profissional;
use Api\Services\ProfissionalService;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;

class ProfissionalController extends AbstractRestfulController
{
    private ProfissionalService $profissionalService;

    public function __construct(ProfissionalService $profissionalService)
    {
        $this->profissionalService = $profissionalService;
    }

    /**
     * GET /api/profissionais
     * Lista todos os profissionais ativos
     */
    public function getList()
    {
        $profissionais = $this->profissionalService->getAllProfissionais();
        return new JsonModel($profissionais);
    }

    /**
     * GET /api/profissionais/:id
     * Retorna profissional por CRM (ou ID, se preferir ajustar)
     */
    public function get($id)
    {
        $profissional = $this->profissionalService->buscarPorCrm($id);
        if (!$profissional) {
            return new JsonModel(['error' => 'Profissional não encontrado']);
        }
        return new JsonModel($profissional);
    }

    /**
     * POST /api/profissionais
     * Cadastra novo profissional
     */
    public function create($data)
    {
        try {
            $profissional = new Profissional(
                $data['nome'],
                $data['email'],
                $data['crm'],
                $data['especialidade']
            );

            $novo = $this->profissionalService->cadastrar($profissional);

            if (!$novo) {
                return new JsonModel(['error' => 'Já existe profissional com esse CRM']);
            }

            return new JsonModel(['success' => true, 'profissional' => $novo]);
        } catch (\Exception $e) {
            return new JsonModel(['error' => $e->getMessage()]);
        }
    }

    /**
     * PUT /api/profissionais/:id
     * Atualiza profissional existente
     */
    public function update($id, $data)
    {
        $profissional = $this->profissionalService->buscarPorCrm($id);
        if (!$profissional) {
            return new JsonModel(['error' => 'Profissional não encontrado']);
        }

        if (isset($data['nome'])) {
            $profissional->setNome($data['nome']);
        }
        if (isset($data['email'])) {
            $profissional->setEmail($data['email']);
        }
        if (isset($data['especialidade'])) {
            $profissional->setEspecialidade($data['especialidade']);
        }

        $this->profissionalService->atualizar($profissional);

        return new JsonModel(['success' => true, 'profissional' => $profissional]);
    }

    /**
     * DELETE /api/profissionais/:id
     * Remove profissional (soft delete)
     */
    public function delete($id)
    {
        $profissional = $this->profissionalService->buscarPorCrm($id);
        if (!$profissional) {
            return new JsonModel(['error' => 'Profissional não encontrado']);
        }

        $this->profissionalService->remover($profissional);

        return new JsonModel(['success' => true]);
    }
}