<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\BladeViewRenderer;

final class PageController
{
    private BladeViewRenderer $renderer;
    private string $baseDir;

    public function __construct(?BladeViewRenderer $renderer = null, ?string $baseDir = null)
    {
        $this->baseDir = $baseDir ?? dirname(__DIR__, 2);
        
        $viewsPath = "{$this->baseDir}/views";
        $cachePath = "{$this->baseDir}/storage/cache/views";

        $this->renderer = $renderer ?? new BladeViewRenderer($viewsPath, $cachePath);
    }

    /**
     * Homepage institucional da IBN da Paz de Guapó
     */
    public function home(): void
    {
        $agendaFile = "{$this->baseDir}/data/programacao/agenda.json";
        $agenda = file_exists($agendaFile) ? json_decode((string) file_get_contents($agendaFile), true) : [];

        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderer->render('pages.home', [
            'agenda' => $agenda,
            'currentRoute' => '/',
        ]);
    }

    /**
     * Página Sobre Nós: história, visão bíblica e liderança
     */
    public function sobre(): void
    {
        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderer->render('pages.sobre', [
            'currentRoute' => '/sobre',
        ]);
    }

    /**
     * Página de Contato e Localização em Guapó-GO
     */
    public function contato(): void
    {
        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderer->render('pages.contato', [
            'currentRoute' => '/contato',
        ]);
    }

    /**
     * Página de erro 404 (Not Found)
     */
    public function notFound(): void
    {
        http_response_code(404);
        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderer->render('pages.404', [
            'currentRoute' => null,
        ]);
    }
}
