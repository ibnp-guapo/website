<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class ChapterDto
{
    /**
     * @param array<ArticleDto> $articles
     */
    public function __construct(
        public string $eId,
        public string $num,
        public string $heading,
        public array $articles = []
    ) {}
}
