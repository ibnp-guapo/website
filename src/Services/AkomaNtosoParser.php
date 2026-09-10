<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\ArticleDto;
use App\DTO\ChapterDto;
use App\DTO\ClauseDto;
use App\DTO\LegalDocumentDto;
use App\DTO\TOCItemDto;
use App\Exceptions\AkomaNtosoParseException;
use DOMDocument;
use DOMElement;
use DOMNodeList;
use DOMXPath;

final class AkomaNtosoParser
{
    private const AKN_NAMESPACE = 'http://docs.oasis-open.org/legaldocml/ns/akn/3.0';

    public function __construct(
        private string $cacheDir = __DIR__ . '/../../storage/cache',
        private bool $useCache = true
    ) {
        if (!is_dir($this->cacheDir)) {
            @mkdir($this->cacheDir, 0777, true);
        }
    }

    /**
     * Faz o parse de um arquivo XML Akoma Ntoso 3.0
     */
    public function parseFile(string $filePath): LegalDocumentDto
    {
        if (!file_exists($filePath)) {
            throw new AkomaNtosoParseException("Arquivo XML não encontrado: {$filePath}");
        }

        $mtime = filemtime($filePath) ?: 0;
        $cacheKey = md5($filePath . '_' . $mtime);
        $cacheFile = "{$this->cacheDir}/akn_{$cacheKey}.cache";

        if ($this->useCache && file_exists($cacheFile)) {
            $cached = @file_get_contents($cacheFile);
            if ($cached !== false) {
                $unserialized = @unserialize($cached);
                if ($unserialized instanceof LegalDocumentDto) {
                    return $unserialized;
                }
            }
        }

        $xmlContent = file_get_contents($filePath);
        if ($xmlContent === false) {
            throw new AkomaNtosoParseException("Falha ao ler o conteúdo do arquivo: {$filePath}");
        }

        $doc = $this->parseXml($xmlContent, $filePath);

        if ($this->useCache && is_dir($this->cacheDir)) {
            @file_put_contents($cacheFile, serialize($doc));
        }

        return $doc;
    }

    /**
     * Faz o parse direto de uma string XML
     */
    public function parseXml(string $xmlContent, string $sourceFile = ''): LegalDocumentDto
    {
        $internalErrors = libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;

        $loaded = $dom->loadXML($xmlContent);
        if (!$loaded) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            libxml_use_internal_errors($internalErrors);
            $msg = 'Erro ao carregar XML Akoma Ntoso: ';
            if (!empty($errors)) {
                $msg .= $errors[0]->message . " (linha: {$errors[0]->line})";
            }
            throw new AkomaNtosoParseException($msg);
        }
        libxml_use_internal_errors($internalErrors);

        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('akn', self::AKN_NAMESPACE);

        // Metadados
        $titleNode = $xpath->query('//akn:preface//akn:docTitle | //akn:preface//akn:p[@class="title"]')->item(0);
        $title = $titleNode ? trim($titleNode->textContent) : 'Documento Institucional';

        $registryNode = $xpath->query('//akn:preface//akn:p[@class="registryNote"]')->item(0);
        $subtitle = $registryNode ? trim($registryNode->textContent) : null;

        $dateNode = $xpath->query('//akn:meta//akn:publication/@date | //akn:meta//akn:FRBRWork/akn:FRBRdate/@date')->item(0);
        $date = $dateNode ? trim($dateNode->nodeValue ?? '') : null;

        $uriNode = $xpath->query('//akn:meta//akn:FRBRWork/akn:FRBRuri/@value')->item(0);
        $frbrUri = $uriNode ? trim($uriNode->nodeValue ?? '') : '';

        $prefaceNode = $xpath->query('//akn:preface')->item(0);
        $preface = $prefaceNode ? trim($prefaceNode->textContent) : null;

        // Tipo do documento
        $actNode = $xpath->query('//akn:act')->item(0);
        $docType = $actNode instanceof DOMElement && $actNode->hasAttribute('name')
            ? $actNode->getAttribute('name')
            : 'documento';

        // Capítulos
        /** @var DOMNodeList<DOMElement> $chapterNodes */
        $chapterNodes = $xpath->query('//akn:body//akn:chapter');
        $chapters = [];
        $toc = [];

        foreach ($chapterNodes as $chapterElement) {
            $capEid = $chapterElement->getAttribute('eId');
            
            $numNode = $xpath->query('akn:num', $chapterElement)->item(0);
            $capNum = $numNode ? trim($numNode->textContent) : '';

            $headingNode = $xpath->query('akn:heading', $chapterElement)->item(0);
            $capHeading = $headingNode ? trim($headingNode->textContent) : '';

            /** @var DOMNodeList<DOMElement> $articleNodes */
            $articleNodes = $xpath->query('akn:article', $chapterElement);
            $articles = [];
            $tocArticles = [];

            foreach ($articleNodes as $articleElement) {
                $artEid = $articleElement->getAttribute('eId');

                $artNumNode = $xpath->query('akn:num', $articleElement)->item(0);
                $artNum = $artNumNode ? trim($artNumNode->textContent) : '';

                // Caput content
                $contentNode = $xpath->query('akn:content/akn:p | akn:content', $articleElement)->item(0);
                $artContent = $contentNode ? trim($contentNode->textContent) : '';

                // Sub-cláusulas (parágrafos, incisos, alíneas)
                $clauses = $this->parseClauses($xpath, $articleElement);

                $articles[] = new ArticleDto(
                    eId: $artEid,
                    num: $artNum,
                    content: $artContent,
                    clauses: $clauses
                );

                $tocArticles[] = new TOCItemDto(
                    eId: $artEid,
                    label: $artNum,
                    title: $artNum . ($artContent !== '' ? ' - ' . mb_substr($artContent, 0, 50) . '...' : '')
                );
            }

            $chapters[] = new ChapterDto(
                eId: $capEid,
                num: $capNum,
                heading: $capHeading,
                articles: $articles
            );

            $toc[] = new TOCItemDto(
                eId: $capEid,
                label: $capNum,
                title: $capHeading !== '' ? "{$capNum}: {$capHeading}" : $capNum,
                children: $tocArticles
            );
        }

        return new LegalDocumentDto(
            docType: $docType,
            title: $title,
            subtitle: $subtitle,
            date: $date,
            preface: $preface,
            chapters: $chapters,
            toc: $toc,
            sourceFile: $sourceFile,
            frbrUri: $frbrUri
        );
    }

    /**
     * Extrai parágrafos, incisos e alíneas de um artigo
     * @return array<ClauseDto>
     */
    private function parseClauses(DOMXPath $xpath, DOMElement $articleElement): array
    {
        $clauses = [];
        
        // Parágrafos diretos do artigo
        /** @var DOMNodeList<DOMElement> $paragraphs */
        $paragraphs = $xpath->query('akn:paragraph', $articleElement);
        foreach ($paragraphs as $para) {
            $pEid = $para->getAttribute('eId');
            $pNumNode = $xpath->query('akn:num', $para)->item(0);
            $pNum = $pNumNode ? trim($pNumNode->textContent) : '';

            $pContentNode = $xpath->query('akn:content/akn:p | akn:content | akn:intro/akn:p | akn:intro', $para)->item(0);
            $pContent = $pContentNode ? trim($pContentNode->textContent) : '';

            $clauses[] = new ClauseDto(
                eId: $pEid,
                type: 'paragraph',
                num: $pNum,
                content: $pContent
            );

            // Incisos dentro do parágrafo
            /** @var DOMNodeList<DOMElement> $subClauses */
            $subClauses = $xpath->query('akn:clause | akn:point', $para);
            foreach ($subClauses as $subClause) {
                $cEid = $subClause->getAttribute('eId');
                $cNumNode = $xpath->query('akn:num', $subClause)->item(0);
                $cNum = $cNumNode ? trim($cNumNode->textContent) : '';

                $cContentNode = $xpath->query('akn:content/akn:p | akn:content', $subClause)->item(0);
                $cContent = $cContentNode ? trim($cContentNode->textContent) : '';

                $clauses[] = new ClauseDto(
                    eId: $cEid,
                    type: $subClause->localName === 'point' ? 'point' : 'clause',
                    num: $cNum,
                    content: $cContent
                );
            }
        }

        // Cláusulas diretas do artigo (se houver sem parágrafo intermediário)
        /** @var DOMNodeList<DOMElement> $directClauses */
        $directClauses = $xpath->query('akn:clause', $articleElement);
        foreach ($directClauses as $clause) {
            $cEid = $clause->getAttribute('eId');
            $cNumNode = $xpath->query('akn:num', $clause)->item(0);
            $cNum = $cNumNode ? trim($cNumNode->textContent) : '';

            $cContentNode = $xpath->query('akn:content/akn:p | akn:content', $clause)->item(0);
            $cContent = $cContentNode ? trim($cContentNode->textContent) : '';

            $clauses[] = new ClauseDto(
                eId: $cEid,
                type: 'clause',
                num: $cNum,
                content: $cContent
            );
        }

        return $clauses;
    }
}
