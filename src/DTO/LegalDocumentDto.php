<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class LegalDocumentDto
{
    /**
     * @param array<ChapterDto> $chapters
     * @param array<TOCItemDto> $toc
     */
    public function __construct(
        public string $docType,
        public string $title,
        public ?string $subtitle,
        public ?string $date,
        public ?string $preface,
        public array $chapters,
        public array $toc,
        public string $sourceFile = '',
        public string $frbrUri = ''
    ) {}

    /**
     * Retorna a contagem total de artigos no documento
     */
    public function countArticles(): int
    {
        $count = 0;
        foreach ($this->chapters as $chapter) {
            $count += count($chapter->articles);
        }
        return $count;
    }
}
