<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DTO\AgendaDto;
use App\DTO\CultoRegularDto;
use App\Services\ICalGenerator;

final class ProgramacaoController
{
    private ICalGenerator $generator;
    private string $baseDir;

    public function __construct(?ICalGenerator $generator = null, ?string $baseDir = null)
    {
        $this->generator = $generator ?? new ICalGenerator();
        $this->baseDir = $baseDir ?? dirname(__DIR__, 2);
    }

    /**
     * Exibe a página de programação de cultos e eventos
     */
    public function index(): void
    {
        $agenda = $this->loadAgenda();
        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderView($agenda);
    }

    /**
     * Retorna o arquivo .ics para download ou assinatura de calendário
     */
    public function ical(): void
    {
        $agenda = $this->loadAgenda();
        $icalContent = $this->generator->generate($agenda);

        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cultos-ibnp-guapo.ics"');
        header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
        echo $icalContent;
        exit;
    }

    /**
     * Carrega e converte data/programacao/agenda.json em AgendaDto
     */
    public function loadAgenda(): AgendaDto
    {
        $filePath = "{$this->baseDir}/data/programacao/agenda.json";
        if (!file_exists($filePath)) {
            return new AgendaDto(
                nomeOrganizacao: 'Igreja Batista Nacional da Paz de Guapó',
                sigla: 'IBN da Paz de Guapó',
                cnpj: '02.930.019/0001-62',
                timezone: 'America/Sao_Paulo',
                enderecoCompleto: 'Rua Presidente Kennedy, Qd. 21, Lt. 13 - Centro, Guapó - GO',
                canais: [],
                cultosRegulares: []
            );
        }

        $data = json_decode((string) file_get_contents($filePath), true);

        $endereco = $data['organizacao']['endereco'] ?? [];
        $enderecoFormatado = sprintf(
            '%s, %s - %s - %s, CEP %s',
            $endereco['logradouro'] ?? '',
            $endereco['bairro'] ?? '',
            $endereco['cidade'] ?? 'Guapó',
            $endereco['uf'] ?? 'GO',
            $endereco['cep'] ?? '75350-000'
        );

        $cultos = [];
        foreach ($data['cultosRegulares'] ?? [] as $c) {
            $cultos[] = new CultoRegularDto(
                id: (string) ($c['id'] ?? ''),
                diaSemana: (string) ($c['diaSemana'] ?? ''),
                horario: (string) ($c['horario'] ?? '19:30'),
                duracaoMinutos: (int) ($c['duracaoMinutos'] ?? 90),
                nome: (string) ($c['nome'] ?? ''),
                categoria: (string) ($c['categoria'] ?? ''),
                local: (string) ($c['local'] ?? ''),
                descricao: (string) ($c['descricao'] ?? ''),
                transmissaoAoVivo: (bool) ($c['transmissaoAoVivo'] ?? false),
                canalTransmissao: isset($c['canalTransmissao']) ? (string) $c['canalTransmissao'] : null,
                rrule: (string) ($c['rrule'] ?? '')
            );
        }

        return new AgendaDto(
            nomeOrganizacao: (string) ($data['organizacao']['nome'] ?? 'Igreja Batista Nacional da Paz de Guapó'),
            sigla: (string) ($data['organizacao']['sigla'] ?? 'IBN da Paz de Guapó'),
            cnpj: (string) ($data['organizacao']['cnpj'] ?? '02.930.019/0001-62'),
            timezone: (string) ($data['organizacao']['timezone'] ?? 'America/Sao_Paulo'),
            enderecoCompleto: $enderecoFormatado,
            canais: (array) ($data['organizacao']['canais'] ?? []),
            cultosRegulares: $cultos,
            eventosEspeciais: (array) ($data['eventosEspeciais'] ?? [])
        );
    }

    /**
     * Renderiza a view da programação
     */
    private function renderView(AgendaDto $agenda): string
    {
        // Geração do Schema.org JSON-LD
        $schemaEvents = [];
        foreach ($agenda->cultosRegulares as $culto) {
            $schemaEvents[] = [
                '@type' => 'Event',
                'name' => $culto->nome,
                'description' => $culto->descricao,
                'eventSchedule' => [
                    '@type' => 'Schedule',
                    'byDay' => str_contains(mb_strtolower($culto->diaSemana), 'quarta') ? 'https://schema.org/Wednesday' : 'https://schema.org/Sunday',
                    'startTime' => $culto->horario . ':00',
                    'endTime' => $culto->getHorarioFim() . ':00',
                    'scheduleTimezone' => $agenda->timezone,
                ],
                'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
                'eventStatus' => 'https://schema.org/EventScheduled',
                'location' => [
                    '@type' => 'Place',
                    'name' => 'IBN da Paz de Guapó - Templo Sede',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Rua Presidente Kennedy, Qd. 21, Lt. 13',
                        'addressLocality' => 'Guapó',
                        'addressRegion' => 'GO',
                        'postalCode' => '75350-000',
                        'addressCountry' => 'BR',
                    ],
                ],
                'organizer' => [
                    '@type' => 'Organization',
                    'name' => $agenda->nomeOrganizacao,
                    'url' => 'https://ibnpguapo.org.br',
                ],
            ];
        }

        $schemaJson = json_encode([
            '@context' => 'https://schema.org',
            '@graph' => $schemaEvents,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        // Renderizar Cards de Cultos
        $cultosCardsHtml = '';
        foreach ($agenda->cultosRegulares as $culto) {
            $diaUpper = mb_strtoupper($culto->diaSemana);
            $horarioFim = $culto->getHorarioFim();

            // Link para adicionar diretamente ao Google Agenda
            $gCalUrl = $this->buildGoogleCalendarUrl($culto, $agenda);

            $cultosCardsHtml .= sprintf(
                '<div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-xs hover:border-slate-300 transition flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-orange-100 text-ibnp-primary">
                                %s
                            </span>
                            <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">
                                %d min
                            </span>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2">%s</h3>
                        <p class="text-sm font-semibold text-ibnp-secondary mb-4">%s</p>
                        <div class="flex items-center gap-2 text-slate-700 text-sm font-bold mb-4 bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <span class="text-lg">⏰</span>
                            <span>%s às %s (Horário de Brasília)</span>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">%s</p>
                        <div class="text-xs text-slate-500 mb-6 flex items-start gap-2">
                            <span class="text-base">📍</span>
                            <span>%s</span>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center gap-3 flex-wrap">
                        <a href="%s" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 text-white text-xs font-bold hover:bg-slate-800 transition shadow-xs">
                            <svg class="w-4 h-4 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 002 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 4h-2v-2h2v2zm4 0h-2v-2h2v2z"/></svg>
                            <span>Adicionar ao Google Agenda</span>
                        </a>
                        <a href="/programacao/ical" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold hover:bg-slate-200 transition">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            <span>Baixar .ics</span>
                        </a>
                    </div>
                </div>',
                htmlspecialchars($diaUpper),
                $culto->duracaoMinutos,
                htmlspecialchars($culto->nome),
                htmlspecialchars($culto->categoria),
                htmlspecialchars($culto->horario),
                htmlspecialchars($horarioFim),
                htmlspecialchars($culto->descricao),
                htmlspecialchars($culto->local),
                htmlspecialchars($gCalUrl)
            );
        }

        return <<<HTML
<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programação e Cultos - IBN da Paz de Guapó</title>
    <meta name="description" content="Horários dos cultos regulares e encontros semanais da Igreja Batista Nacional da Paz de Guapó-GO. Quartas e Domingos às 19:30.">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script type="application/ld+json">
{$schemaJson}
    </script>
</head>
<body class="h-full flex flex-col text-slate-800 antialiased font-sans">
    <!-- Header Principal -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <span class="w-9 h-9 rounded-lg bg-ibnp-primary flex items-center justify-center text-white font-black text-lg shadow-sm">P</span>
                <span class="font-extrabold text-lg text-slate-900 tracking-tight">IBN da Paz <span class="text-ibnp-primary font-bold">Guapó</span></span>
            </a>
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600">
                <a href="/" class="hover:text-ibnp-primary transition">Início</a>
                <a href="/programacao" class="text-ibnp-primary font-bold border-b-2 border-ibnp-primary pb-0.5">Programação</a>
                <a href="/estatuto" class="hover:text-ibnp-primary transition">Estatuto</a>
                <a href="/regimento" class="hover:text-ibnp-primary transition">Regimento</a>
                <a href="/sobre" class="hover:text-ibnp-primary transition">Sobre</a>
                <a href="/contato" class="hover:text-ibnp-primary transition">Contato</a>
            </nav>
        </div>
    </header>

    <!-- Banner Hero da Programação -->
    <section class="bg-slate-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-orange-600/30 text-orange-300 border border-orange-500/30 mb-4">
                    📅 Grade Semanal Oficial
                </span>
                <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4">
                    Cultos & Encontros de Fé
                </h1>
                <p class="text-slate-300 text-base sm:text-lg leading-relaxed font-light mb-8">
                    Venha celebrar ao Senhor e crescer na graça com sua família em Guapó-GO. Nossas reuniões regulares acontecem às quartas e domingos, com duração de 90 minutos de acolhimento e edificação bíblica.
                </p>
                <div class="flex items-center gap-3 flex-wrap">
                    <a href="/programacao/ical" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-ibnp-primary text-white text-sm font-bold hover:bg-orange-700 transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        <span>Sincronizar Calendário Completo (.ics)</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Cultos Regulares -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight mb-1">Cultos Semanais Regulares</h2>
            <p class="text-slate-500 text-sm">Reuniões presenciais realizadas no Templo Sede da IBN da Paz de Guapó.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            {$cultosCardsHtml}
        </div>

        <!-- Seção de Eventos Especiais -->
        <section class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 shadow-xs">
            <div class="max-w-2xl">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Próximos Acontecimentos</span>
                <h2 class="text-2xl font-black text-slate-900 mt-1 mb-3">Eventos Especiais & Conferências</h2>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">
                    No momento, nossa programação segue a grade regular semanal de cultos. Novas conferências, batismos e vigílias são anunciados previamente nos cultos e em nosso Instagram oficial.
                </p>
                <a href="https://instagram.com/ibnp_guapo" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 text-slate-800 text-xs font-bold hover:bg-slate-200 transition">
                    <span>Acompanhar no Instagram @ibnp_guapo</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 text-xs py-8 border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
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

    /**
     * Monta a URL de deep-link para adicionar diretamente ao Google Agenda
     */
    private function buildGoogleCalendarUrl(CultoRegularDto $culto, AgendaDto $agenda): string
    {
        $diaSemanaLower = mb_strtolower($culto->diaSemana);
        $baseDate = str_contains($diaSemanaLower, 'quarta') ? '20260107' : '20260104';

        $startTimeClean = str_replace(':', '', $culto->horario) . '00';
        $endTimeClean = str_replace(':', '', $culto->getHorarioFim()) . '00';

        $dates = "{$baseDate}T{$startTimeClean}/{$baseDate}T{$endTimeClean}";

        $params = [
            'action' => 'TEMPLATE',
            'text' => $culto->nome . ' - ' . $agenda->sigla,
            'dates' => $dates,
            'details' => $culto->descricao,
            'location' => $culto->local,
            'ctz' => $agenda->timezone,
            'recur' => 'RRULE:' . $culto->rrule,
        ];

        return 'https://calendar.google.com/calendar/render?' . http_build_query($params);
    }
}
