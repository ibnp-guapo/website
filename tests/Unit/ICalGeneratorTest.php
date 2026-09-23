<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Controllers\ProgramacaoController;
use App\Services\ICalGenerator;
use PHPUnit\Framework\TestCase;

final class ICalGeneratorTest extends TestCase
{
    private ICalGenerator $generator;
    private ProgramacaoController $controller;

    protected function setUp(): void
    {
        $this->generator = new ICalGenerator();
        $this->controller = new ProgramacaoController($this->generator);
    }

    public function testGenerateCompliesWithRfc5545(): void
    {
        $agenda = $this->controller->loadAgenda();
        $ical = $this->generator->generate($agenda);

        $this->assertStringStartsWith("BEGIN:VCALENDAR\r\n", $ical);
        $this->assertStringContainsString("VERSION:2.0\r\n", $ical);
        $this->assertStringContainsString("CALSCALE:GREGORIAN\r\n", $ical);
        $this->assertStringContainsString("BEGIN:VTIMEZONE\r\n", $ical);
        $this->assertStringContainsString("TZID:America/Sao_Paulo\r\n", $ical);
        $this->assertStringEndsWith("END:VCALENDAR\r\n", $ical);
    }

    public function testGenerateContainsExactlyTwoRegularServicesWith90MinDuration(): void
    {
        $agenda = $this->controller->loadAgenda();
        $ical = $this->generator->generate($agenda);

        // Contar VEVENTs
        $veventCount = substr_count($ical, 'BEGIN:VEVENT');
        $this->assertSame(2, $veventCount, 'O arquivo .ics deve conter exatamente 2 VEVENTs regulares');

        // Validar Encontro de Quarta (19:30 às 21:00)
        $this->assertStringContainsString('UID:culto-quarta-ensino@ibnpguapo.org.br', $ical);
        $this->assertStringContainsString('RRULE:FREQ=WEEKLY;BYDAY=WE', $ical);
        $this->assertStringContainsString('T193000', $ical);
        $this->assertStringContainsString('T210000', $ical);
        $this->assertStringContainsString('Encontro de Ensino & Formação de Valores', $ical);

        // Validar Encontro de Domingo (19:30 às 21:00)
        $this->assertStringContainsString('UID:culto-domingo-celebracao@ibnpguapo.org.br', $ical);
        $this->assertStringContainsString('RRULE:FREQ=WEEKLY;BYDAY=SU', $ical);
        $this->assertStringContainsString('Encontro Comunitário de Celebração & Acolhimento', $ical);
        $this->assertStringNotContainsString('Culto de Celebração da Família', $ical);

        // Confirmar ausência de sábados
        $this->assertStringNotContainsString('BYDAY=SA', $ical);
    }
}
