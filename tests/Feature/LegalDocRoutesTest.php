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
        $this->assertStringContainsString('Documento Oficial', $output);
        $this->assertStringNotContainsString('Akoma Ntoso', $output);

        // Deve estender layouts.app com tokens Stitch e navegação canônica
        $this->assertStringContainsString('IBN da Paz de Guapó', $output);
        $this->assertStringContainsString('/assets/images/logo-ibnp.png', $output);
        $this->assertStringContainsString('Plus Jakarta Sans', $output);
        $this->assertStringContainsString('material-symbols-outlined', $output);
        $this->assertStringContainsString('02.930.019/0001-62', $output);
        $this->assertStringContainsString('elevation-warm-1', $output);

        // Responsividade mobile do sumário: sticky somente no desktop e TOC colapsável
        $this->assertStringContainsString('lg:sticky', $output);
        $this->assertStringContainsString('lg:top-24', $output);
        $this->assertStringContainsString('id="toc-mobile-toggle"', $output);
        $this->assertStringContainsString('id="toc-container"', $output);
        $this->assertStringNotContainsString('sticky top-24', $output);

        // Não deve conter artefatos de heredoc legados
        $this->assertStringNotContainsString('>P</span>', $output);
        $this->assertStringNotContainsString('family=Inter', $output);
        $this->assertStringNotContainsString('bg-slate-900', $output);
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
        $this->assertStringNotContainsString('Akoma Ntoso', $output);

        // Deve estender layouts.app com tokens Stitch
        $this->assertStringContainsString('IBN da Paz de Guapó', $output);
        $this->assertStringContainsString('/assets/images/logo-ibnp.png', $output);
        $this->assertStringContainsString('Plus Jakarta Sans', $output);
        $this->assertStringContainsString('material-symbols-outlined', $output);
        $this->assertStringContainsString('02.930.019/0001-62', $output);
        $this->assertStringContainsString('elevation-warm-1', $output);

        // Não deve conter artefatos de heredoc legados
        $this->assertStringNotContainsString('>P</span>', $output);
        $this->assertStringNotContainsString('family=Inter', $output);
        $this->assertStringNotContainsString('bg-slate-900', $output);
    }
}
