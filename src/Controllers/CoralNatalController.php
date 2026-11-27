<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\BladeViewRenderer;
use App\Services\InscricaoCoralService;

final class CoralNatalController
{
    /**
     * Inscrições do Coral de Natal. A edição de 2026 não acontece; a próxima é no fim de 2027.
     * Para reabrir, mude INSCRICOES_ABERTAS para true (o formulário continua na view).
     */
    public const INSCRICOES_ABERTAS = false;
    public const PROXIMA_EDICAO = 'dezembro de 2027';

    private InscricaoCoralService $service;
    private BladeViewRenderer $renderer;
    private bool $inscricoesAbertas;

    public function __construct(
        ?InscricaoCoralService $service = null,
        ?BladeViewRenderer $renderer = null,
        ?bool $inscricoesAbertas = null
    ) {
        $this->inscricoesAbertas = $inscricoesAbertas ?? self::INSCRICOES_ABERTAS;
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
            'inscricoesAbertas' => $this->inscricoesAbertas,
            'proximaEdicao' => self::PROXIMA_EDICAO,
            'sucesso' => false,
            'erros' => [],
            'old' => [],
        ]);
    }

    /**
     * Processa a submissão do formulário de inscrição.
     * Com as inscrições fechadas, não grava nada e mostra o aviso da próxima edição.
     */
    public function inscrever(): void
    {
        if (!$this->inscricoesAbertas) {
            $this->index();
            return;
        }

        $dados = $_POST ?? [];
        $resultado = $this->service->inscrever($dados);
        $statusVagas = $this->service->getStatusVagas();

        header('Content-Type: text/html; charset=utf-8');

        if ($resultado['sucesso']) {
            echo $this->renderer->render('pages.coral-natal', [
                'currentRoute' => '/coral-natal',
                'statusVagas' => $statusVagas,
                'inscricoesAbertas' => true,
                'proximaEdicao' => self::PROXIMA_EDICAO,
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
            'inscricoesAbertas' => true,
            'proximaEdicao' => self::PROXIMA_EDICAO,
            'sucesso' => false,
            'erros' => $resultado['erros'],
            'old' => $dados,
        ]);
    }
}
