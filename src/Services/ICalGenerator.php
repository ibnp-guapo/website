<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\AgendaDto;
use App\DTO\CultoRegularDto;

final class ICalGenerator
{
    /**
     * Gera o conteúdo do arquivo .ics no padrão RFC 5545
     */
    public function generate(AgendaDto $agenda): string
    {
        $lines = [];

        $lines[] = 'BEGIN:VCALENDAR';
        $lines[] = 'VERSION:2.0';
        $lines[] = 'PRODID:-//IBN da Paz de Guapo//Website//PT-BR';
        $lines[] = 'CALSCALE:GREGORIAN';
        $lines[] = 'METHOD:PUBLISH';
        $lines[] = 'X-WR-CALNAME:' . $this->escapeText($agenda->sigla . ' - Cultos');
        $lines[] = 'X-WR-TIMEZONE:' . $agenda->timezone;

        // Bloco VTIMEZONE para America/Sao_Paulo
        $lines[] = 'BEGIN:VTIMEZONE';
        $lines[] = 'TZID:America/Sao_Paulo';
        $lines[] = 'X-LIC-LOCATION:America/Sao_Paulo';
        $lines[] = 'BEGIN:STANDARD';
        $lines[] = 'TZOFFSETFROM:-0300';
        $lines[] = 'TZOFFSETTO:-0300';
        $lines[] = 'TZNAME:-03';
        $lines[] = 'DTSTART:19700101T000000';
        $lines[] = 'END:STANDARD';
        $lines[] = 'END:VTIMEZONE';

        // Eventos de Cultos Regulares
        foreach ($agenda->cultosRegulares as $culto) {
            $lines = array_merge($lines, $this->buildVEvent($culto, $agenda->timezone));
        }

        $lines[] = 'END:VCALENDAR';

        return implode("\r\n", $lines) . "\r\n";
    }

    /**
     * Constrói o bloco VEVENT de um culto regular
     * @return array<string>
     */
    private function buildVEvent(CultoRegularDto $culto, string $timezone): array
    {
        $eventLines = [];
        $eventLines[] = 'BEGIN:VEVENT';
        $eventLines[] = 'UID:' . $culto->id . '@ibnpguapo.org.br';
        $eventLines[] = 'DTSTAMP:20260101T000000Z';

        // Determinar a data base de referência para a primeira ocorrência
        // 2026-01-04 foi Domingo
        // 2026-01-07 foi Quarta-feira
        $diaSemanaLower = mb_strtolower($culto->diaSemana);
        $baseDate = str_contains($diaSemanaLower, 'quarta') ? '20260107' : '20260104';

        $startTimeClean = str_replace(':', '', $culto->horario) . '00';
        $endTimeClean = str_replace(':', '', $culto->getHorarioFim()) . '00';

        $eventLines[] = "DTSTART;TZID={$timezone}:{$baseDate}T{$startTimeClean}";
        $eventLines[] = "DTEND;TZID={$timezone}:{$baseDate}T{$endTimeClean}";

        if ($culto->rrule !== '') {
            $eventLines[] = 'RRULE:' . $culto->rrule;
        }

        $eventLines[] = 'SUMMARY:' . $this->escapeText($culto->nome);
        $eventLines[] = 'DESCRIPTION:' . $this->escapeText($culto->descricao);
        $eventLines[] = 'LOCATION:' . $this->escapeText($culto->local);
        $eventLines[] = 'STATUS:CONFIRMED';
        $eventLines[] = 'CATEGORIES:' . $this->escapeText($culto->categoria);
        $eventLines[] = 'END:VEVENT';

        return $eventLines;
    }

    /**
     * Escapa caracteres especiais conforme especificação RFC 5545
     */
    private function escapeText(string $text): string
    {
        $text = str_replace('\\', '\\\\', $text);
        $text = str_replace(';', '\;', $text);
        $text = str_replace(',', '\,', $text);
        $text = str_replace(["\r\n", "\n", "\r"], '\n', $text);

        return $text;
    }
}
