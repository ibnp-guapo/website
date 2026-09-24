<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\BladeViewRenderer;
use App\Services\InscricaoCoralService;

final class CoralNatalController
{
    private InscricaoCoralService $service;
    private BladeViewRenderer $renderer;

    public function __construct(
        ?InscricaoCoralService $service = null,
        ?BladeViewRenderer $renderer = null
    ) {
        $baseDir = dirname(__DIR__, 2);
        $this->service = $service ?? new InscricaoCoralService();
        $this->renderer = $renderer ?? new BladeViewRenderer(
            "{$baseDir}/views",
            "{$baseDir}/storage/cache/views"
        );
    }

    /**
     * Exibe a página oficial de apresentação e inscrição do Coral de Natal.
     */
    public function index(): void
    {
        $statusVagas = $this->service->getStatusVagas();

        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderer->render('pages.coral-natal', [
            'currentRoute' => '/coral-natal',
            'statusVagas' => $statusVagas,
            'sucesso' => false,
            'erros' => [],
            'old' => [],
        ]);
    }

    /**
     * Processa a submissão do formulário de inscrição.
     */
    public function inscrever(): void
    {
        $dados = $_POST ?? [];
        $resultado = $this->service->inscrever($dados);
        $statusVagas = $this->service->getStatusVagas();

        header('Content-Type: text/html; charset=utf-8');

        if ($resultado['sucesso']) {
            echo $this->renderer->render('pages.coral-natal', [
                'currentRoute' => '/coral-natal',
                'statusVagas' => $statusVagas,
                'sucesso' => true,
                'inscricao' => $resultado['inscricao'] ?? null,
                'erros' => [],
                'old' => [],
            ]);
            return;
        }

        echo $this->renderer->render('pages.coral-natal', [
            'currentRoute' => '/coral-natal',
            'statusVagas' => $statusVagas,
            'sucesso' => false,
            'erros' => $resultado['erros'],
            'old' => $dados,
        ]);
    }
}
