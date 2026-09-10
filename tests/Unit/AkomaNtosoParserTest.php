<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Exceptions\AkomaNtosoParseException;
use App\Services\AkomaNtosoParser;
use PHPUnit\Framework\TestCase;

final class AkomaNtosoParserTest extends TestCase
{
    private string $xmlPath;
    private AkomaNtosoParser $parser;
    private string $tempCacheDir;

    protected function setUp(): void
    {
        $this->xmlPath = dirname(__DIR__, 2) . '/data/legal/estatuto-social.akn.xml';
        $this->tempCacheDir = sys_get_temp_dir() . '/akn_test_cache_' . uniqid();
        $this->parser = new AkomaNtosoParser(cacheDir: $this->tempCacheDir, useCache: true);
    }

    protected function tearDown(): void
    {
        // Limpar diretório de teste de cache
        if (is_dir($this->tempCacheDir)) {
            $files = glob("{$this->tempCacheDir}/*") ?: [];
            foreach ($files as $file) {
                @unlink($file);
            }
            @rmdir($this->tempCacheDir);
        }
    }

    public function testParseFileExtractsMetadataCorrectly(): void
    {
        $doc = $this->parser->parseFile($this->xmlPath);

        $this->assertSame('estatutoSocial', $doc->docType);
        $this->assertSame('ESTATUTO DA IGREJA BATISTA NACIONAL DA PAZ DE GUAPÓ', $doc->title);
        $this->assertSame('2002-03-25', $doc->date);
        $this->assertStringContainsString('Registrado e Averbado', (string) $doc->subtitle);
    }

    public function testParseFileExtractsAllChaptersAndArticles(): void
    {
        $doc = $this->parser->parseFile($this->xmlPath);

        $this->assertCount(5, $doc->chapters, 'O Estatuto Social deve conter 5 capítulos');
        $this->assertSame(18, $doc->countArticles(), 'O Estatuto Social deve conter 18 artigos');

        // Validar Capítulo I
        $cap1 = $doc->chapters[0];
        $this->assertSame('cap_1', $cap1->eId);
        $this->assertSame('Capítulo I', $cap1->num);
        $this->assertSame('Da Denominação, Sede, Fins e Duração', $cap1->heading);
        $this->assertCount(2, $cap1->articles);

        // Validar Artigo 1
        $art1 = $cap1->articles[0];
        $this->assertSame('art_1', $art1->eId);
        $this->assertSame('Art. 1º', $art1->num);
        $this->assertStringContainsString('A Igreja Batista Nacional da Paz de Guapó', $art1->content);

        // Validar Artigo 18 (Último)
        $cap5 = $doc->chapters[4];
        $art18 = $cap5->articles[array_key_last($cap5->articles)];
        $this->assertSame('art_18', $art18->eId);
        $this->assertSame('Art. 18', $art18->num);
    }

    public function testTableOfContentsStructure(): void
    {
        $doc = $this->parser->parseFile($this->xmlPath);

        $this->assertCount(5, $doc->toc, 'TOC deve conter 5 entradas principais (capítulos)');
        $this->assertSame('cap_1', $doc->toc[0]->eId);
        $this->assertCount(2, $doc->toc[0]->children, 'Capítulo I deve conter 2 artigos no sumário');
        $this->assertSame('art_1', $doc->toc[0]->children[0]->eId);
    }

    public function testCacheMechanismStoresAndRetrievesDto(): void
    {
        // 1ª execução: gera cache
        $doc1 = $this->parser->parseFile($this->xmlPath);

        $cachedFiles = glob("{$this->tempCacheDir}/akn_*.cache");
        $this->assertNotEmpty($cachedFiles, 'Arquivo de cache deve ser gerado no diretório temporário');

        // 2ª execução: deve recuperar do cache
        $doc2 = $this->parser->parseFile($this->xmlPath);
        $this->assertSame($doc1->title, $doc2->title);
        $this->assertSame($doc1->countArticles(), $doc2->countArticles());
    }

    public function testThrowsExceptionWhenFileNotFound(): void
    {
        $this->expectException(AkomaNtosoParseException::class);
        $this->expectExceptionMessage('Arquivo XML não encontrado');

        $this->parser->parseFile('/caminho/inexistente/documento.xml');
    }

    public function testThrowsExceptionWhenXmlIsMalformed(): void
    {
        $this->expectException(AkomaNtosoParseException::class);
        $this->expectExceptionMessage('Erro ao carregar XML Akoma Ntoso');

        $this->parser->parseXml('<akomaNtoso><act><unclosed_tag></act></akomaNtoso>');
    }
}
