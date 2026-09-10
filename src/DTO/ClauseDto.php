<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class ClauseDto
{
    public function __construct(
        public string $eId,
        public string $type, // 'paragraph', 'clause', etc.
        public string $num,  // ex: '§ 1º', 'I -', 'a)'
        public string $content
    ) {}
}
