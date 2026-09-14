<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DTO\AgendaDto;
use App\DTO\CultoRegularDto;
use App\Services\BladeViewRenderer;
use App\Services\ICalGenerator;

final class ProgramacaoController
{
    private ICalGenerator $generator;
    private BladeViewRenderer $renderer;
    private string $baseDir;

    public function __construct(
        ?ICalGenerator $generator = null,
        ?BladeViewRenderer $renderer = null,
        ?string $baseDir = null
    ) {
        $this->generator = $generator ?? new ICalGenerator();
        $this->baseDir = $baseDir ?? dirname(__DIR__, 2);

        $viewsPath = "{$this->baseDir}/views";
        $cachePath = "{$this->baseDir}/storage/cache/views";
        $this->renderer = $renderer ?? new BladeViewRenderer($viewsPath, $cachePath);
    }

    /**
     * Exibe a página de programação de cultos e eventos
     */
    public function index(): void
    {
        $agenda = $this->loadAgenda();

        // Geração do Schema.org JSON-LD
        $schemaEvents = [];
        $googleCalendarUrls = [];

        foreach ($agenda->cultosRegulares as $culto) {
            $googleCalendarUrls[$culto->id] = $this->buildGoogleCalendarUrl($culto, $agenda);

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

        $schemaJson = (string) json_encode([
            '@context' => 'https://schema.org',
            '@graph' => $schemaEvents,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderer->render('pages.programacao', [
            'agenda' => $agenda,
            'currentRoute' => '/programacao',
            'schemaJson' => $schemaJson,
            'googleCalendarUrls' => $googleCalendarUrls,
        ]);
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
        return;
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
