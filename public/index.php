<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;

$router = new Router();

// Controller de Páginas Institucionais (Blade)
$pageController = new \App\Controllers\PageController();

// Rota 1: Home (Página Inicial)
$router->get('/', function () use ($pageController): void {
    $pageController->home();
});

// Controller de Programação de Cultos e Calendário iCal
$programacaoController = new \App\Controllers\ProgramacaoController();

// Rota 2: Programação & Cultos
$router->get('/programacao', function () use ($programacaoController): void {
    $programacaoController->index();
});

// Rota 3: Download de Calendário (.ics / RFC 5545)
$router->get('/programacao/ical', function () use ($programacaoController): void {
    $programacaoController->ical();
});

// Controller de Documentos Legais (Akoma Ntoso 3.0)
$legalController = new \App\Controllers\LegalDocController();

// Rota 4: Estatuto Social (Visualizador Akoma Ntoso 3.0)
$router->get('/estatuto', function () use ($legalController): void {
    $legalController->estatuto();
});

// Rota 4.1: Download do XML original do Estatuto Social
$router->get('/estatuto/xml', function () use ($legalController): void {
    $legalController->downloadEstatutoXml();
});

// Rota 5: Regimento Interno (Visualizador ou Aviso de Transcrição)
$router->get('/regimento', function () use ($legalController): void {
    $legalController->regimento();
});

// Rota 5.1: Download do XML do Regimento Interno
$router->get('/regimento/xml', function () use ($legalController): void {
    $legalController->downloadRegimentoXml();
});

// Rota 6: Sobre Nós
$router->get('/sobre', function () use ($pageController): void {
    $pageController->sobre();
});

// Rota 7: Contato & Localização
$router->get('/contato', function () use ($pageController): void {
    $pageController->contato();
});

// Tratamento 404 (Not Found)
$router->set404(function () use ($pageController): void {
    $pageController->notFound();
});

$router->run();

