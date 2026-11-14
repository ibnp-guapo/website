<?php

declare(strict_types=1);

namespace App\DTO;

/**
 * Post do blog (Spec 25), montado a partir de data/blog/<slug>.md.
 */
final class BlogPostDto
{
    /**
     * @param list<string> $tags
     */
    public function __construct(
        public readonly string $slug,
        public readonly string $titulo,
        public readonly string $resumo,
        public readonly \DateTimeImmutable $data,
        public readonly ?\DateTimeImmutable $atualizado,
        public readonly string $categoria,
        public readonly array $tags,
        public readonly ?string $serie,
        public readonly string $html,
        public readonly int $minutosLeitura,
    ) {
    }

    public function url(): string
    {
        return '/blog/' . $this->slug;
    }

    /** Data por extenso em português, ex.: "14 de novembro de 2026". */
    public static function dataPorExtenso(\DateTimeImmutable $data): string
    {
        $meses = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];

        return sprintf('%d de %s de %d', (int) $data->format('j'), $meses[(int) $data->format('n') - 1], (int) $data->format('Y'));
    }
}
