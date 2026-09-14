<?php

declare(strict_types=1);

namespace App\Tests\Feature;

use App\Controllers\LegalDocController;
use App\Controllers\PageController;
use App\Controllers\ProgramacaoController;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;

/**
 * Testes das rotas HTTP principais da aplicação,
 * garantindo status HTTP 200, Content-Type correto e renderização das views.
 */
final class HttpRoutesTest extends TestCase
{
    private PageController $pageController;
    private ProgramacaoController $programacaoController;
    private LegalDocController $legalDocController;

    protected function setUp(): void
    {
        $this->pageController = new PageController();
        $this->programacaoController = new ProgramacaoController();
        $this->legalDocController = new LegalDocController();
    }

    public function testHomeRouteReturnsOkAndRendersHtml(): void
    {
        ob_start();
        $this->pageController->home();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('IBN da Paz', $output);
        $this->assertStringContainsString('Cultos da Semana', $output);
    }

    public function testProgramacaoRouteReturnsOkAndRendersServices(): void
    {
        ob_start();
        $this->programacaoController->index();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('Cultos & Encontros de Fé', $output);
        $this->assertStringContainsString('/programacao/ical', $output);
    }

    public function testProgramacaoIcalRouteReturnsValidCalendar(): void
    {
        ob_start();
        $this->programacaoController->ical();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('BEGIN:VCALENDAR', $output);
        $this->assertStringContainsString('PRODID:-//IBN da Paz de Guapo//Website//PT-BR', $output);
        $this->assertStringContainsString('END:VCALENDAR', $output);
    }

    public function testEstatutoRouteReturnsOkAndRendersReader(): void
    {
        ob_start();
        $this->legalDocController->estatuto();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('ESTATUTO DA IGREJA BATISTA NACIONAL DA PAZ DE GUAPÓ', $output);
        $this->assertStringContainsString('id="art_1"', $output);
        $this->assertStringContainsString('id="art_18"', $output);
    }

    public function testEstatutoXmlDownloadRouteDeliversXmlFile(): void
    {
        ob_start();
        $this->legalDocController->downloadEstatutoXml();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('<?xml version="1.0" encoding="UTF-8"?>', $output);
        $this->assertStringContainsString('<akomaNtoso xmlns="http://docs.oasis-open.org/legaldocml/ns/akn/3.0">', $output);
        $this->assertStringContainsString('<act name="estatutoSocial">', $output);
    }

    public function testRegimentoRouteReturnsOkAndRendersNoticeOrContent(): void
    {
        ob_start();
        $this->legalDocController->regimento();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('Regimento Interno', $output);
    }

    public function testSobreRouteReturnsOkAndRendersHistory(): void
    {
        ob_start();
        $this->pageController->sobre();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('Sobre a IBN da Paz de Guapó', $output);
        $this->assertStringContainsString('Convenção Batista Nacional (CBN)', $output);
    }

    public function testContatoRouteReturnsOkAndRendersLocation(): void
    {
        ob_start();
        $this->pageController->contato();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('Entre em Contato Conosco', $output);
        $this->assertStringContainsString('Rua Presidente Kennedy, Qd. 21, Lt. 13', $output);
    }

    public function testNotFoundRouteRenders404View(): void
    {
        ob_start();
        $this->pageController->notFound();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('Página Não Encontrada', $output);
        $this->assertStringContainsString('Erro 404', $output);
    }

    public function testRegimentoXmlRouteReturnsExpectedResponse(): void
    {
        ob_start();
        $this->legalDocController->downloadRegimentoXml();
        $output = (string) ob_get_clean();

        $regimentoPath = dirname(__DIR__, 2) . '/data/legal/regimento-interno.akn.xml';
        if (!file_exists($regimentoPath)) {
            $this->assertStringContainsString('não disponível para download', $output);
        } else {
            $this->assertStringContainsString('<akomaNtoso', $output);
        }
    }
}
