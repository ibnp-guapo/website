<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Controllers\LegalDocController;
use PHPUnit\Framework\TestCase;

final class LegalDocRoutesTest extends TestCase
{
    private LegalDocController $controller;

    protected function setUp(): void
    {
        $this->controller = new LegalDocController();
    }

    public function testEstatutoRendersSuccessfullyWithHtmlContent(): void
    {
        ob_start();
        $this->controller->estatuto();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('ESTATUTO DA IGREJA BATISTA NACIONAL DA PAZ DE GUAPÓ', $output);
        $this->assertStringContainsString('id="art_1"', $output);
        $this->assertStringContainsString('id="art_18"', $output);
        $this->assertStringContainsString('id="cap_1"', $output);
        $this->assertStringContainsString('copyPermalink', $output);
        $this->assertStringContainsString('search-input', $output);
        $this->assertStringContainsString('OASIS Akoma Ntoso 3.0', $output);
    }

    public function testRegimentoRendersTranscriptionNoticeWhenXmlDoesNotExist(): void
    {
        ob_start();
        $this->controller->regimento();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('Regimento Interno', $output);
        $this->assertStringContainsString('Documento em Transcrição Semântica', $output);
        $this->assertStringContainsString('Issue #4', $output);
    }
}
