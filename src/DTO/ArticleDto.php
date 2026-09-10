<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class ArticleDto
{
    /**
     * @param array<ClauseDto> $clauses
     */
    public function __construct(
        public string $eId,
        public string $num,
        public string $content,
        public array $clauses = []
    ) {}
}
