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
        $this->assertStringContainsString('Culto de Ensino', $output);
        $this->assertStringContainsString('Culto de Celebração', $output);
        $this->assertStringNotContainsString('Celebração da Família', $output);
        $this->assertStringNotContainsString('EBD', $output);
        $this->assertStringContainsString('19:30 às 21:00', $output);
        $this->assertStringContainsString('Estatuto Social', $output);
        $this->assertStringContainsString('Regimento Interno', $output);
        $this->assertStringContainsString('Akoma Ntoso', $output);
        $this->assertStringContainsString('wa.me/556298700089', $output);
        $this->assertStringContainsString('/assets/images/logo-ibnp.png', $output);

        // Validações da seção e links da Ação Social (Issue #14 / Spec 12)
        $this->assertStringContainsString('Escola Social de Guapó', $output);
        $this->assertStringContainsString('https://social.ibnpguapo.org.br/', $output);
        $this->assertStringContainsString('Educação Infantil', $output);
        $this->assertStringContainsString('Contraturno Escolar', $output);
        $this->assertStringContainsString('Centro Comunitário', $output);
        $this->assertStringContainsString('child_care', $output);
        $this->assertStringContainsString('construction', $output);
        $this->assertStringContainsString('Construção', $output);
        $this->assertStringContainsString('target="_blank"', $output);
        $this->assertStringContainsString('rel="noopener noreferrer"', $output);
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
        $this->assertStringContainsString('/assets/images/logo-ibnp.png', $output);
        $this->assertStringContainsString('material-symbols-outlined', $output);
        $this->assertStringContainsString('menu_book', $output);
        $this->assertStringContainsString('auto_awesome', $output);
        $this->assertStringContainsString('cross', $output);
        $this->assertStringContainsString('diversity_1', $output);
        $this->assertStringContainsString('account_balance', $output);
        $this->assertStringContainsString('assignment', $output);
        $this->assertStringContainsString('elevation-warm-1', $output);

        // Validações institucionais da mantenedora da Escola Social (Issue #14 / Spec 12)
        $this->assertStringContainsString('Mantenedora da Escola Social de Guapó', $output);
        $this->assertStringContainsString('https://social.ibnpguapo.org.br/', $output);
        $this->assertStringContainsString('construction', $output);
        $this->assertStringContainsString('construção e estruturação', $output);

        // Garante ausência de classes e emojis legados
        $this->assertStringNotContainsString('bg-slate-900', $output);
        $this->assertStringNotContainsString('bg-ibnp-primary', $output);
        $this->assertStringNotContainsString('text-ibnp-primary', $output);
        $this->assertStringNotContainsString('border-slate-200', $output);
        $this->assertStringNotContainsString('📖', $output);
        $this->assertStringNotContainsString('🕊️', $output);
        $this->assertStringNotContainsString('✝️', $output);
        $this->assertStringNotContainsString('🤝', $output);
        $this->assertStringNotContainsString('🏛️', $output);
        $this->assertStringNotContainsString('📋', $output);
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
        $this->assertStringContainsString('material-symbols-outlined', $output);
        $this->assertStringContainsString('church', $output);
        $this->assertStringContainsString('chat', $output);
        $this->assertStringContainsString('call', $output);
        $this->assertStringContainsString('directions', $output);
        $this->assertStringContainsString('photo_camera', $output);
        $this->assertStringContainsString('play_circle', $output);
        $this->assertStringContainsString('elevation-warm-1', $output);

        // Garante ausência de classes e emojis legados
        $this->assertStringNotContainsString('bg-slate-900', $output);
        $this->assertStringNotContainsString('bg-ibnp-primary', $output);
        $this->assertStringNotContainsString('border-slate-200', $output);
        $this->assertStringNotContainsString('📍', $output);
        $this->assertStringNotContainsString('🏛️', $output);
        $this->assertStringNotContainsString('💬', $output);
        $this->assertStringNotContainsString('📞', $output);
        $this->assertStringNotContainsString('📸', $output);
        $this->assertStringNotContainsString('▶️', $output);
    }

    public function testNotFoundRendersStitchViewWithoutLegacyArtifacts(): void
    {
        ob_start();
        $this->controller->notFound();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('Página Não Encontrada', $output);
        $this->assertStringContainsString('Erro 404', $output);
        $this->assertStringContainsString('Voltar para o Início', $output);
        $this->assertStringContainsString('Ver Programação', $output);
        $this->assertStringContainsString('material-symbols-outlined', $output);
        $this->assertStringContainsString('travel_explore', $output);
        $this->assertStringContainsString('home', $output);
        $this->assertStringContainsString('calendar_month', $output);
        $this->assertStringContainsString('elevation-warm-1', $output);

        // Garante ausência de classes e emojis legados
        $this->assertStringNotContainsString('🕊️', $output);
        $this->assertStringNotContainsString('bg-slate-100', $output);
        $this->assertStringNotContainsString('bg-ibnp-primary', $output);
        $this->assertStringNotContainsString('border-slate-200', $output);
    }
}
