<?php

declare(strict_types=1);

namespace App\Tests\Feature;

use App\Controllers\BlogController;
use PHPUnit\Framework\TestCase;

final class BlogRoutesTest extends TestCase
{
    private function render(callable $acao): string
    {
        ob_start();
        $acao(new BlogController());

        return (string) ob_get_clean();
    }

    public function testListaDoBlogMostraOsPosts(): void
    {
        $html = $this->render(fn (BlogController $c) => $c->index());

        $this->assertStringContainsString('<!DOCTYPE html>', $html);
        $this->assertStringContainsString('Blog da IBNP', $html);
        $this->assertStringContainsString('href="/blog/cadastro-unico-em-guapo"', $html);
        $this->assertStringContainsString('href="/blog/bolsa-familia-quem-tem-direito"', $html);
        $this->assertStringContainsString('href="/blog/cadastro-unico-desatualizado"', $html);
        $this->assertStringContainsString('<link rel="canonical" href="https://ibnpguapo.org.br/blog">', $html);
    }

    public function testPostRenderizaConteudoSeoEDadosEstruturados(): void
    {
        $html = $this->render(fn (BlogController $c) => $c->show('cadastro-unico-em-guapo'));

        $this->assertStringContainsString('<h1', $html);
        $this->assertStringContainsString('Cadastro Único em Guapó', $html);
        $this->assertStringContainsString('<meta property="og:type" content="article">', $html);
        $this->assertStringContainsString('<link rel="canonical" href="https://ibnpguapo.org.br/blog/cadastro-unico-em-guapo">', $html);
        $this->assertStringContainsString('"@type":"BlogPosting"', $html);
        $this->assertStringContainsString('class="artigo"', $html);
        $this->assertStringContainsString('Rua São Salvador', $html);
        $this->assertStringContainsString('Leia também', $html);
        $this->assertStringContainsString('wa.me/5562998700089', $html);
    }

    public function testPostComTabelaRenderizaTabelaRolavel(): void
    {
        $html = $this->render(fn (BlogController $c) => $c->show('bolsa-familia-quem-tem-direito'));

        $this->assertStringContainsString('<div class="artigo-tabela"><table>', $html);
        $this->assertStringContainsString('R$ 691', $html);
    }

    public function testSlugInexistenteRetorna404(): void
    {
        $html = $this->render(fn (BlogController $c) => $c->show('nao-existe'));

        $this->assertSame(404, http_response_code());
        $this->assertStringContainsString('Página Não Encontrada', $html);
        http_response_code(200);
    }

    public function testConteudoRespeitaVocabularioAdGrants(): void
    {
        foreach (['cadastro-unico-em-guapo', 'bolsa-familia-quem-tem-direito', 'cadastro-unico-desatualizado'] as $slug) {
            $html = mb_strtolower($this->render(fn (BlogController $c) => $c->show($slug)));
            $this->assertStringNotContainsString('em obras', $html, $slug);
            $this->assertStringNotContainsString('em construção', $html, $slug);
        }
    }
}
