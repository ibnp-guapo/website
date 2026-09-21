<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Controllers\ProgramacaoController;
use PHPUnit\Framework\TestCase;

final class ProgramacaoRoutesTest extends TestCase
{
    private ProgramacaoController $controller;

    protected function setUp(): void
    {
        $this->controller = new ProgramacaoController();
    }

    public function testProgramacaoRendersHtmlWithServicesAndSchemaOrg(): void
    {
        ob_start();
        $this->controller->index();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('Cultos & Encontros de Fé', $output);
        $this->assertStringContainsString('Culto de Ensino', $output);
        $this->assertStringContainsString('Culto de Celebração', $output);
        $this->assertStringNotContainsString('Celebração da Família', $output);
        $this->assertStringContainsString('19:30 às 21:00', $output);
        $this->assertStringContainsString('90 min', $output);
        $this->assertStringContainsString('application/ld+json', $output);
        $this->assertStringContainsString('https://schema.org', $output);
        $this->assertStringContainsString('calendar.google.com/calendar/render', $output);
        $this->assertStringContainsString('/programacao/ical', $output);

        // Deve estender layouts.app com tokens Stitch e elementos canônicos
        $this->assertStringContainsString('IBN da Paz de Guapó', $output);
        $this->assertStringContainsString('/assets/images/logo-ibnp.png', $output);
        $this->assertStringContainsString('Plus Jakarta Sans', $output);
        $this->assertStringContainsString('material-symbols-outlined', $output);
        $this->assertStringContainsString('02.930.019/0001-62', $output);
        $this->assertStringContainsString('elevation-warm-1', $output);

        // Não deve conter menção a transmissão ao vivo nem artefatos de heredoc legados
        $this->assertStringNotContainsString('Transmissão ao Vivo', $output);
        $this->assertStringNotContainsString('>P</span>', $output);
        $this->assertStringNotContainsString('family=Inter', $output);
        $this->assertStringNotContainsString('bg-slate-900', $output);
    }

    public function testLoadAgendaReturnsValidData(): void
    {
        $agenda = $this->controller->loadAgenda();
        $this->assertSame('Igreja Batista Nacional da Paz de Guapó', $agenda->nomeOrganizacao);
        $this->assertCount(2, $agenda->cultosRegulares);

        foreach ($agenda->cultosRegulares as $culto) {
            $this->assertSame(90, $culto->duracaoMinutos);
            $this->assertFalse($culto->transmissaoAoVivo);
            $this->assertSame('21:00', $culto->getHorarioFim());
        }
    }
}
