<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Controllers\PageController;
use PHPUnit\Framework\TestCase;

final class PageRoutesTest extends TestCase
{
    private PageController $controller;

    protected function setUp(): void
    {
        $this->controller = new PageController();
    }

    public function testHomeRendersBladeViewWithEssentialSections(): void
    {
        ob_start();
        $this->controller->home();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('IBN da Paz', $output);
        $this->assertStringContainsString('Guapó', $output);
        $this->assertStringContainsString('Cultos da Semana', $output);
        $this->assertStringContainsString('Culto de Oração e Estudo Bíblico', $output);
        $this->assertStringContainsString('Celebração da Família', $output);
        $this->assertStringContainsString('19:30 às 21:00', $output);
        $this->assertStringContainsString('Estatuto Social', $output);
        $this->assertStringContainsString('Regimento Interno', $output);
        $this->assertStringContainsString('Akoma Ntoso', $output);
        $this->assertStringContainsString('wa.me/556298700089', $output);
    }

    public function testSobreRendersHistoryAndCbnAffiliation(): void
    {
        ob_start();
        $this->controller->sobre();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('Sobre a IBN da Paz de Guapó', $output);
        $this->assertStringContainsString('14 de janeiro de 1999', $output);
        $this->assertStringContainsString('Convenção Batista Nacional (CBN)', $output);
        $this->assertStringContainsString('ORMIBAN', $output);
        $this->assertStringContainsString('02.930.019/0001-62', $output);
    }

    public function testContatoRendersLocationAndChannels(): void
    {
        ob_start();
        $this->controller->contato();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('Entre em Contato Conosco', $output);
        $this->assertStringContainsString('Rua Presidente Kennedy, Qd. 21, Lt. 13', $output);
        $this->assertStringContainsString('(62) 9870-0089', $output);
        $this->assertStringContainsString('@ibnp_guapo', $output);
        $this->assertStringContainsString('@ibnpguapo', $output);
        $this->assertStringContainsString('google.com/maps/embed', $output);
    }
}
