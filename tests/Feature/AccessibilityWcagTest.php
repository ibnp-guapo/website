<?php

declare(strict_types=1);

namespace App\Tests\Feature;

use App\Controllers\LegalDocController;
use App\Controllers\PageController;
use App\Controllers\ProgramacaoController;
use PHPUnit\Framework\TestCase;

/**
 * Auditoria de Acessibilidade Digital (WCAG 2.1 AA):
 * - Validação matemática dos contrastes de cores da paleta institucional.
 * - Validação da semântica ARIA, landmarks, navegação por teclado e leitor de documentos.
 */
final class AccessibilityWcagTest extends TestCase
{
    private PageController $pageController;
    private LegalDocController $legalDocController;
    private ProgramacaoController $programacaoController;

    protected function setUp(): void
    {
        $this->pageController = new PageController();
        $this->legalDocController = new LegalDocController();
        $this->programacaoController = new ProgramacaoController();
    }

    /**
     * Calcula a luminância relativa de uma cor hexadecimal conforme especificação W3C WCAG 2.1
     */
    private function calculateRelativeLuminance(string $hex): float
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        $r = hexdec(substr($hex, 0, 2)) / 255.0;
        $g = hexdec(substr($hex, 2, 2)) / 255.0;
        $b = hexdec(substr($hex, 4, 2)) / 255.0;

        $rLinear = ($r <= 0.04045) ? ($r / 12.92) : pow(($r + 0.055) / 1.055, 2.4);
        $gLinear = ($g <= 0.04045) ? ($g / 12.92) : pow(($g + 0.055) / 1.055, 2.4);
        $bLinear = ($b <= 0.04045) ? ($b / 12.92) : pow(($b + 0.055) / 1.055, 2.4);

        return 0.2126 * $rLinear + 0.7152 * $gLinear + 0.0722 * $bLinear;
    }

    /**
     * Calcula a razão de contraste (Contrast Ratio) entre duas cores
     */
    private function calculateContrastRatio(string $color1, string $color2): float
    {
        $lum1 = $this->calculateRelativeLuminance($color1);
        $lum2 = $this->calculateRelativeLuminance($color2);

        $lighter = max($lum1, $lum2);
        $darker = min($lum1, $lum2);

        return ($lighter + 0.05) / ($darker + 0.05);
    }

    public function testBrandColorsContrastRatioConformsToWcag21AA(): void
    {
        $coral = '#F43517';
        $orange = '#F36529';
        $navy = '#0F172A';
        $white = '#FFFFFF';
        $surfaceLight = '#F8FAFC';

        // 1. Marinho (#0F172A) sobre Branco (#FFFFFF) e Surface (#F8FAFC) - Texto normal (>= 4.5:1)
        $ratioNavyWhite = $this->calculateContrastRatio($navy, $white);
        $this->assertGreaterThanOrEqual(
            4.5,
            $ratioNavyWhite,
            "Contraste do texto marinho sobre branco deve ser >= 4.5:1 (obtido: {$ratioNavyWhite})"
        );

        $ratioNavySurface = $this->calculateContrastRatio($navy, $surfaceLight);
        $this->assertGreaterThanOrEqual(
            4.5,
            $ratioNavySurface,
            "Contraste do texto marinho sobre surface deve ser >= 4.5:1 (obtido: {$ratioNavySurface})"
        );

        // 2. Vermelho Coral (#F43517) e Laranja (#F36529) como botões ou destaques sobre fundos escuros e claros
        // Para elementos gráficos e texto em destaque / grande porte, WCAG AA requer >= 3.0:1
        $ratioCoralNavy = $this->calculateContrastRatio($coral, $navy);
        $this->assertGreaterThanOrEqual(
            3.0,
            $ratioCoralNavy,
            "Contraste do coral sobre marinho deve ser >= 3.0:1 (obtido: {$ratioCoralNavy})"
        );

        $ratioOrangeNavy = $this->calculateContrastRatio($orange, $navy);
        $this->assertGreaterThanOrEqual(
            3.0,
            $ratioOrangeNavy,
            "Contraste do laranja sobre marinho deve ser >= 3.0:1 (obtido: {$ratioOrangeNavy})"
        );

        // 3. Texto branco sobre Marinho
        $ratioWhiteNavy = $this->calculateContrastRatio($white, $navy);
        $this->assertGreaterThanOrEqual(
            7.0,
            $ratioWhiteNavy,
            "Contraste de texto branco sobre cabeçalho/rodapé marinho deve cumprir nível AAA >= 7.0:1"
        );
    }

    public function testBaseLayoutProvidesAccessibleHtmlStructureAndLandmarks(): void
    {
        ob_start();
        $this->pageController->home();
        $html = (string) ob_get_clean();

        // 1. Tag HTML com atributo de idioma
        $this->assertMatchesRegularExpression(
            '/<html[^>]+lang=["\']pt-BR["\']/i',
            $html,
            'O documento HTML deve conter lang="pt-BR" para acessibilidade de leitores de tela.'
        );

        // 2. Viewport responsivo para acessibilidade de zoom
        $this->assertStringContainsString('name="viewport"', $html);
        $this->assertStringContainsString('width=device-width', $html);

        // 3. Landmarks essenciais (WCAG 2.1)
        $this->assertStringContainsString('<header', $html, 'Deve conter elemento semântico <header>.');
        $this->assertStringContainsString('<main', $html, 'Deve conter elemento semântico <main>.');
        $this->assertStringContainsString('<footer', $html, 'Deve conter elemento semântico <footer>.');
        $this->assertStringContainsString('<nav', $html, 'Deve conter elemento semântico <nav>.');

        // 4. Imagens com atributos alt
        $this->assertMatchesRegularExpression(
            '/<img[^>]+alt=["\'][^"\']*["\']/i',
            $html,
            'Imagens no layout devem conter atributo alt descritivo.'
        );
    }

    public function testLegalDocReaderProvidesKeyboardNavigationAndSemanticAnchors(): void
    {
        ob_start();
        $this->legalDocController->estatuto();
        $html = (string) ob_get_clean();

        // 1. Permalinks e âncoras identificadas para navegação por teclado/leitor
        $this->assertStringContainsString('id="art_1"', $html);
        $this->assertStringContainsString('id="art_18"', $html);
        $this->assertStringContainsString('id="cap_1"', $html);

        // 2. Campo de busca acessível com placeholder e/ou aria-label
        $this->assertMatchesRegularExpression(
            '/<input[^>]+(aria-label|placeholder)=["\'][^"\']*["\']/i',
            $html,
            'O campo de busca do leitor deve conter identificador acessível (aria-label ou placeholder).'
        );

        // 3. Títulos em hierarquia semântica (h1, h2, h3)
        $this->assertStringContainsString('<h1', $html, 'Deve conter título principal h1.');
        $this->assertStringContainsString('<h2', $html, 'Deve conter títulos de seção h2.');

        // 4. Atributos ARIA ou botões com indicação de ação
        $this->assertStringContainsString('copyPermalink', $html);
    }
}
