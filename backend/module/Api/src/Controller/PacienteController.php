<?php

namespace Api\Controller;

use Api\Entity\Paciente;
use Api\Services\PacienteService;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;

class PacienteController extends AbstractRestfulController
{
    private PacienteService $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    /**
     * GET /api/pacientes
     * Lista todos os pacientes ativos
     */
    public function getList()
    {
        $pacientes = $this->pacienteService->getAllPacientes();
        return new JsonModel($pacientes);
    }

    /**
     * GET /api/pacientes/:id
     * Retorna paciente por ID
     */
    public function get($id)
    {
        $paciente = $this->pacienteService->buscarPorCpf($id); // aqui você pode trocar para buscarPorId
        if (!$paciente) {
            return new JsonModel(['error' => 'Paciente não encontrado']);
        }
        return new JsonModel($paciente);
    }

    /**
     * POST /api/pacientes
     * Cadastra novo paciente
     */
    public function create($data)
    {
        try {
            $paciente = new Paciente(
                $data['nome'],
                $data['cpf'],
                new \DateTimeImmutable($data['dataNasc'])
            );

            $novo = $this->pacienteService->cadastrar($paciente);

            if (!$novo) {
                return new JsonModel(['error' => 'Já existe paciente com esse CPF']);
            }

            return new JsonModel(['success' => true, 'paciente' => $novo]);
        } catch (\Exception $e) {
            return new JsonModel(['error' => $e->getMessage()]);
        }
    }

    /**
     * PUT /api/pacientes/:id
     * Atualiza paciente existente
     */
    public function update($id, $data)
    {
        $paciente = $this->pacienteService->buscarPorCpf($id);
        if (!$paciente) {
            return new JsonModel(['error' => 'Paciente não encontrado']);
        }

        if (isset($data['nome'])) {
            $paciente->setNome($data['nome']);
        }
        if (isset($data['dataNasc'])) {
            $paciente->setDataNasc(new \DateTimeImmutable($data['dataNasc']));
        }

        $this->pacienteService->atualizar($paciente);

        return new JsonModel(['success' => true, 'paciente' => $paciente]);
    }

    /**
     * DELETE /api/pacientes/:id
     * Remove paciente (soft delete)
     */
    public function delete($id)
    {
        $paciente = $this->pacienteService->buscarPorCpf($id);
        if (!$paciente) {
            return new JsonModel(['error' => 'Paciente não encontrado']);
        }

        $this->pacienteService->remover($paciente);

        return new JsonModel(['success' => true]);
    }
}