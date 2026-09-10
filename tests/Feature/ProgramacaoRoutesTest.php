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
        $this->assertStringContainsString('Culto de Oração e Estudo Bíblico', $output);
        $this->assertStringContainsString('Culto de Celebração da Família', $output);
        $this->assertStringContainsString('19:30 às 21:00', $output);
        $this->assertStringContainsString('90 min', $output);
        $this->assertStringContainsString('application/ld+json', $output);
        $this->assertStringContainsString('https://schema.org', $output);
        $this->assertStringContainsString('calendar.google.com/calendar/render', $output);
        $this->assertStringContainsString('/programacao/ical', $output);

        // Não deve conter menção a transmissão ao vivo
        $this->assertStringNotContainsString('Transmissão ao Vivo', $output);
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
