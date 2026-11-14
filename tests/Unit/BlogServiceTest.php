<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\DTO\BlogPostDto;
use App\Services\BlogService;
use PHPUnit\Framework\TestCase;

final class BlogServiceTest extends TestCase
{
    private string $dir;

    protected function setUp(): void
    {
        $this->dir = sys_get_temp_dir() . '/ibnp-blog-' . bin2hex(random_bytes(4));
        mkdir($this->dir);
    }

    protected function tearDown(): void
    {
        array_map('unlink', glob($this->dir . '/*') ?: []);
        rmdir($this->dir);
    }

    private function post(string $slug, string $data, string $corpo = 'Texto do post.'): void
    {
        file_put_contents("{$this->dir}/{$slug}.md", "---\ntitulo: \"Título {$slug}\"\nresumo: Resumo {$slug}\ndata: {$data}\ntags: [CRAS, Guapó]\n---\n\n{$corpo}\n");
    }

    public function testListaPostsDoMaisRecenteParaOMaisAntigoEOcultaAgendados(): void
    {
        $this->post('antigo', '2026-10-01');
        $this->post('novo', '2026-11-14');
        $this->post('agendado', '2026-12-25');

        $posts = (new BlogService($this->dir))->all(new \DateTimeImmutable('2026-11-14'));

        $this->assertSame(['novo', 'antigo'], array_map(fn (BlogPostDto $p) => $p->slug, $posts));
        $this->assertSame('Título novo', $posts[0]->titulo);
        $this->assertSame('2026-11-14', $posts[0]->data->format('Y-m-d'));
        $this->assertSame(['CRAS', 'Guapó'], $posts[0]->tags);
        $this->assertSame('/blog/novo', $posts[0]->url());
    }

    public function testFindRecusaSlugInvalidoEPostAgendado(): void
    {
        $this->post('publicado', '2026-11-01');
        $this->post('agendado', '2026-12-25');
        $blog = new BlogService($this->dir);
        $hoje = new \DateTimeImmutable('2026-11-14');

        $this->assertNotNull($blog->find('publicado', $hoje));
        $this->assertNull($blog->find('agendado', $hoje));
        $this->assertNull($blog->find('../composer', $hoje));
        $this->assertNull($blog->find('nao-existe', $hoje));
    }

    public function testMarkdownViraHtmlComTabelaEHtmlCruEscapado(): void
    {
        $this->post('tabela', '2026-11-01', "## Seção\n\n| A | B |\n| :-- | :-- |\n| 1 | 2 |\n\n<script>alert(1)</script>\n\n[x](javascript:alert(1))");

        $post = (new BlogService($this->dir))->find('tabela', new \DateTimeImmutable('2026-11-14'));

        $this->assertNotNull($post);
        $this->assertStringContainsString('<h2>Seção</h2>', $post->html);
        $this->assertStringContainsString('<div class="artigo-tabela"><table>', $post->html);
        $this->assertStringNotContainsString('<script>', $post->html);
        $this->assertStringNotContainsString('javascript:', $post->html);
    }

    public function testCampoObrigatorioAusenteFalhaComMensagemClara(): void
    {
        file_put_contents("{$this->dir}/sem-resumo.md", "---\ntitulo: Sem resumo\ndata: 2026-11-01\n---\n\nTexto.\n");

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('resumo');
        (new BlogService($this->dir))->all();
    }

    public function testDataPorExtenso(): void
    {
        $this->assertSame('14 de novembro de 2026', BlogPostDto::dataPorExtenso(new \DateTimeImmutable('2026-11-14')));
    }

    public function testPostsReaisDoSiteSaoValidos(): void
    {
        $posts = (new BlogService(__DIR__ . '/../../data/blog'))->all(new \DateTimeImmutable('2099-01-01'));

        $this->assertNotEmpty($posts);
        foreach ($posts as $post) {
            $this->assertNotSame('', trim($post->resumo), $post->slug);
            $this->assertLessThanOrEqual(170, mb_strlen($post->resumo), "{$post->slug}: resumo longo demais para a meta description");
            // Links internos para outros posts precisam apontar para posts existentes
            preg_match_all('#href="/blog/([a-z0-9-]+)"#', $post->html, $m);
            foreach ($m[1] as $alvo) {
                $this->assertFileExists(__DIR__ . "/../../data/blog/{$alvo}.md", "{$post->slug} aponta para /blog/{$alvo}, que não existe");
            }
        }
    }
}
