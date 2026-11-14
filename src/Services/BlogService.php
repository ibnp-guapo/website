<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\BlogPostDto;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

/**
 * Blog (Spec 25): posts em Markdown com front matter YAML em data/blog/*.md.
 * O nome do arquivo é o slug. HTML cru no Markdown é escapado e links inseguros são bloqueados.
 */
final class BlogService
{
    private const SLUG_PATTERN = '/^[a-z0-9]+(?:-[a-z0-9]+)*$/';

    private MarkdownConverter $converter;

    /** @var array<string, BlogPostDto>|null */
    private ?array $cache = null;

    public function __construct(private readonly string $postsDir)
    {
        $environment = new Environment([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
            'table' => ['wrap' => ['enabled' => true, 'tag' => 'div', 'attributes' => ['class' => 'artigo-tabela']]],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new FrontMatterExtension());

        $this->converter = new MarkdownConverter($environment);
    }

    /**
     * Posts publicados (data <= hoje), do mais recente para o mais antigo.
     *
     * @return list<BlogPostDto>
     */
    public function all(?\DateTimeImmutable $hoje = null): array
    {
        $hoje ??= new \DateTimeImmutable('today', new \DateTimeZone('America/Sao_Paulo'));

        $posts = array_values(array_filter(
            $this->load(),
            fn (BlogPostDto $post): bool => $post->data->format('Y-m-d') <= $hoje->format('Y-m-d'),
        ));
        // Mais recente primeiro; no mesmo dia, segue a ordem da série ("1 de 3", "2 de 3"...) e depois o slug.
        usort($posts, fn (BlogPostDto $a, BlogPostDto $b): int => [$b->data, $a->serie ?? '', $a->slug] <=> [$a->data, $b->serie ?? '', $b->slug]);

        return $posts;
    }

    public function find(string $slug, ?\DateTimeImmutable $hoje = null): ?BlogPostDto
    {
        if (preg_match(self::SLUG_PATTERN, $slug) !== 1) {
            return null;
        }

        foreach ($this->all($hoje) as $post) {
            if ($post->slug === $slug) {
                return $post;
            }
        }

        return null;
    }

    /** @return array<string, BlogPostDto> */
    private function load(): array
    {
        if ($this->cache !== null) {
            return $this->cache;
        }

        $this->cache = [];
        foreach (glob(rtrim($this->postsDir, '/\\') . '/*.md') ?: [] as $file) {
            $post = $this->parse($file);
            $this->cache[$post->slug] = $post;
        }

        return $this->cache;
    }

    private function parse(string $file): BlogPostDto
    {
        $slug = basename($file, '.md');
        if (preg_match(self::SLUG_PATTERN, $slug) !== 1) {
            throw new \RuntimeException("Nome de arquivo inválido para post do blog: {$slug}.md");
        }

        $result = $this->converter->convert((string) file_get_contents($file));
        $meta = $result instanceof RenderedContentWithFrontMatter ? (array) $result->getFrontMatter() : [];

        foreach (['titulo', 'resumo', 'data'] as $campo) {
            if (empty($meta[$campo])) {
                throw new \RuntimeException("Post {$slug}: campo obrigatório \"{$campo}\" ausente no front matter");
            }
        }

        $html = $result->getContent();
        $palavras = str_word_count(strip_tags($html), 0, 'ÁÉÍÓÚÂÊÔÃÕÇáéíóúâêôãõçàÀüÜ');

        return new BlogPostDto(
            slug: $slug,
            titulo: (string) $meta['titulo'],
            resumo: (string) $meta['resumo'],
            data: $this->date($meta['data']),
            atualizado: isset($meta['atualizado']) ? $this->date($meta['atualizado']) : null,
            categoria: (string) ($meta['categoria'] ?? 'Blog'),
            tags: array_values(array_map('strval', (array) ($meta['tags'] ?? []))),
            serie: isset($meta['serie']) ? (string) $meta['serie'] : null,
            html: $html,
            minutosLeitura: max(1, (int) ceil($palavras / 200)),
        );
    }

    private function date(mixed $valor): \DateTimeImmutable
    {
        // O parser YAML entrega datas como timestamp (int); strings ISO também são aceitas.
        $tz = new \DateTimeZone('America/Sao_Paulo');
        $iso = is_int($valor) ? gmdate('Y-m-d', $valor) : (string) $valor;

        return new \DateTimeImmutable($iso, $tz);
    }
}
