<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;

$router = new Router();

// Rota 1: Home (Página Inicial)
$router->get('/', function (): void {
    header('Content-Type: text/html; charset=utf-8');
    echo renderPage(
        title: 'IBN da Paz de Guapó - Página Inicial',
        heading: 'Igreja Batista Nacional da Paz de Guapó',
        subtitle: 'Lugar de recomeço, comunhão e adoração ao Senhor',
        body: '<p class="text-slate-600 mb-6">Seja bem-vindo ao portal oficial da IBN da Paz de Guapó. Aqui você encontra nossa programação de cultos, estatuto e regimento consolidados, e canais de contato com a liderança pastoral.</p>
               <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                 <a href="/programacao" class="p-4 rounded-xl border border-slate-200 hover:border-ibnp-primary transition bg-slate-50 hover:bg-white shadow-sm">
                   <h3 class="font-bold text-slate-800 mb-1">📅 Programação & Cultos</h3>
                   <p class="text-sm text-slate-500">Quartas às 19:30 e Domingos às 19:30.</p>
                 </a>
                 <a href="/estatuto" class="p-4 rounded-xl border border-slate-200 hover:border-ibnp-primary transition bg-slate-50 hover:bg-white shadow-sm">
                   <h3 class="font-bold text-slate-800 mb-1">📜 Estatuto Social</h3>
                   <p class="text-sm text-slate-500">Consulta ao documento legal em formato Akoma Ntoso 3.0.</p>
                 </a>
                 <a href="/contato" class="p-4 rounded-xl border border-slate-200 hover:border-ibnp-primary transition bg-slate-50 hover:bg-white shadow-sm">
                   <h3 class="font-bold text-slate-800 mb-1">📍 Localização & Contato</h3>
                   <p class="text-sm text-slate-500">Rua Presidente Kennedy, Qd. 21, Lt. 13 – Centro, Guapó – GO.</p>
                 </a>
               </div>'
    );
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

// Rota 6: Sobre
$router->get('/sobre', function (): void {
    header('Content-Type: text/html; charset=utf-8');
    echo renderPage(
        title: 'Sobre Nós - IBN da Paz de Guapó',
        heading: 'Sobre a IBN da Paz de Guapó',
        subtitle: 'Nossa história, identidade bíblica e liderança pastoral',
        body: '<div class="space-y-4 text-slate-600">
                 <p>Fundada em 14 de janeiro de 1999, a <strong>Igreja Batista Nacional da Paz de Guapó</strong> é uma organização religiosa sem fins lucrativos vinculada à Convenção Batista Nacional (CBN) e à ORMIBAN Goiás.</p>
                 <p>Nossa missão é proclamar as Boas Novas de Jesus Cristo, promover o discipulado bíblico e servir à comunidade de Guapó e região com amor e excelência espiritual.</p>
               </div>'
    );
});

// Rota 7: Contato
$router->get('/contato', function (): void {
    header('Content-Type: text/html; charset=utf-8');
    echo renderPage(
        title: 'Contato & Localização - IBN da Paz de Guapó',
        heading: 'Canais Oficiais e Localização',
        subtitle: 'Entre em contato conosco ou venha nos visitar em nossa sede em Guapó - GO',
        body: '<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                 <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
                   <h3 class="text-lg font-bold text-slate-800 mb-3">📍 Endereço Sede</h3>
                   <p class="text-slate-600 text-sm">Rua Presidente Kennedy, Qd. 21, Lt. 13<br>Centro, Guapó – GO<br>CEP: 75350-000</p>
                 </div>
                 <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
                   <h3 class="text-lg font-bold text-slate-800 mb-3">📞 Contato & Redes</h3>
                   <p class="text-slate-600 text-sm mb-2"><strong>WhatsApp / Telefone:</strong> +55 62 9870-0089</p>
                   <p class="text-slate-600 text-sm mb-2"><strong>Instagram:</strong> <a href="https://instagram.com/ibnp_guapo" target="_blank" class="text-ibnp-primary hover:underline">@ibnp_guapo</a></p>
                   <p class="text-slate-600 text-sm"><strong>YouTube:</strong> <a href="https://youtube.com/@ibnpguapo" target="_blank" class="text-ibnp-primary hover:underline">@ibnpguapo</a></p>
                 </div>
               </div>'
    );
});

// Tratamento 404 (Not Found)
$router->set404(function (): void {
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    echo renderPage(
        title: 'Página Não Encontrada (404) - IBN da Paz de Guapó',
        heading: '404 - Página Não Encontrada',
        subtitle: 'O endereço solicitado não foi localizado em nosso portal',
        body: '<p class="text-slate-600 mb-6">Verifique se o link foi digitado corretamente ou utilize a navegação abaixo para retornar ao início.</p>
               <a href="/" class="inline-flex items-center px-4 py-2 bg-ibnp-primary text-white text-sm font-semibold rounded-lg hover:bg-orange-700 transition">
                 Voltar para o Início
               </a>'
    );
});

$router->run();

/**
 * Função utilitária de renderização temporária com Tailwind CSS
 */
function renderPage(string $title, string $heading, string $subtitle, string $body): string
{
    return <<<HTML
<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
    <meta name="description" content="Website oficial da Igreja Batista Nacional da Paz de Guapó - GO">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Merriweather:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
</head>
<body class="h-full flex flex-col text-slate-800 antialiased font-sans">
    <!-- Header -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <span class="w-9 h-9 rounded-lg bg-ibnp-primary flex items-center justify-center text-white font-black text-lg shadow-sm">P</span>
                <span class="font-extrabold text-lg text-slate-900 tracking-tight">IBN da Paz <span class="text-ibnp-primary font-bold">Guapó</span></span>
            </a>
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600">
                <a href="/" class="hover:text-ibnp-primary transition">Início</a>
                <a href="/programacao" class="hover:text-ibnp-primary transition">Programação</a>
                <a href="/estatuto" class="hover:text-ibnp-primary transition">Estatuto</a>
                <a href="/regimento" class="hover:text-ibnp-primary transition">Regimento</a>
                <a href="/sobre" class="hover:text-ibnp-primary transition">Sobre</a>
                <a href="/contato" class="hover:text-ibnp-primary transition">Contato</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-12">
            <header class="mb-8 border-b border-slate-100 pb-6">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">{$heading}</h1>
                <p class="text-base text-slate-500 font-normal">{$subtitle}</p>
            </header>
            <section>
                {$body}
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 text-xs py-8 border-t border-slate-800">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <p class="font-semibold text-slate-200">Igreja Batista Nacional da Paz de Guapó</p>
                <p class="text-slate-400">CNPJ: 02.930.019/0001-62 • Fundada em 14/01/1999 • Filiada à CBN e ORMIBAN Goiás</p>
            </div>
            <p>&copy; 2026 IBN da Paz de Guapó. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
HTML;
}
