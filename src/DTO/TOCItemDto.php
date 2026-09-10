<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class TOCItemDto
{
    /**
     * @param array<TOCItemDto> $children
     */
    public function __construct(
        public string $eId,
        public string $label,
        public string $title,
        public array $children = []
    ) {}
}
