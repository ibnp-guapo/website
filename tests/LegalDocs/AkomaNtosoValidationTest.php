<?php

declare(strict_types=1);

namespace App\Tests\LegalDocs;

use DOMDocument;
use DOMXPath;
use PHPUnit\Framework\TestCase;

/**
 * Validação formal dos documentos legais em padrão OASIS Akoma Ntoso 3.0 XSD
 * e integridade semântica dos identificadores estruturais (eId).
 */
final class AkomaNtosoValidationTest extends TestCase
{
    private const string AKN_NAMESPACE = 'http://docs.oasis-open.org/legaldocml/ns/akn/3.0';

    private string $schemaPath;
    private string $estatutoXmlPath;
    private string $regimentoXmlPath;

    protected function setUp(): void
    {
        $baseDir = dirname(__DIR__, 2);
        $this->schemaPath = "{$baseDir}/schemas/akomantoso30.xsd";
        $this->estatutoXmlPath = "{$baseDir}/data/legal/estatuto-social.akn.xml";
        $this->regimentoXmlPath = "{$baseDir}/data/legal/regimento-interno.akn.xml";
    }

    public function testOasisSchemaFilesExistLocally(): void
    {
        $this->assertFileExists($this->schemaPath, 'O schema oficial akomantoso30.xsd deve existir em schemas/');
        $xmlSchemaPath = dirname($this->schemaPath) . '/xml.xsd';
        $this->assertFileExists($xmlSchemaPath, 'O schema dependente xml.xsd deve existir em schemas/');
    }

    public function testEstatutoSocialConformsToOfficialAkomaNtoso30Xsd(): void
    {
        $this->assertFileExists($this->estatutoXmlPath, 'Arquivo estatuto-social.akn.xml não encontrado.');

        $dom = new DOMDocument();
        $loaded = $dom->load($this->estatutoXmlPath);
        $this->assertTrue($loaded, 'Falha ao carregar estatuto-social.akn.xml como documento DOM.');

        libxml_use_internal_errors(true);
        libxml_clear_errors();

        $isValid = $dom->schemaValidate($this->schemaPath);
        $errors = libxml_get_errors();
        libxml_clear_errors();

        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = sprintf('[Linha %d] %s', $error->line, trim($error->message));
        }

        $this->assertTrue(
            $isValid,
            "estatuto-social.akn.xml não validou contra o schema Akoma Ntoso 3.0:\n" . implode("\n", $errorMessages)
        );
    }

    public function testRegimentoInternoXmlConformsToOfficialXsdIfPresent(): void
    {
        if (!file_exists($this->regimentoXmlPath)) {
            // Documento em fase de transcrição semântica (Issue #4)
            $this->assertFileDoesNotExist(
                $this->regimentoXmlPath,
                'Regimento Interno ainda em fase de transcrição semântica.'
            );
            return;
        }

        $dom = new DOMDocument();
        $this->assertTrue($dom->load($this->regimentoXmlPath));

        libxml_use_internal_errors(true);
        libxml_clear_errors();

        $isValid = $dom->schemaValidate($this->schemaPath);
        $errors = libxml_get_errors();
        libxml_clear_errors();

        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = sprintf('[Linha %d] %s', $error->line, trim($error->message));
        }

        $this->assertTrue(
            $isValid,
            "regimento-interno.akn.xml não validou contra o schema Akoma Ntoso 3.0:\n" . implode("\n", $errorMessages)
        );
    }

    public function testAllElementIdsAreGloballyUnique(): void
    {
        $dom = new DOMDocument();
        $dom->load($this->estatutoXmlPath);

        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('akn', self::AKN_NAMESPACE);

        $nodesWithEid = $xpath->query('//*[@eId]');
        $this->assertNotFalse($nodesWithEid);
        $this->assertGreaterThan(0, $nodesWithEid->length, 'O documento deve conter elementos com atributos eId.');

        $eids = [];
        $duplicates = [];

        foreach ($nodesWithEid as $node) {
            $eid = $node->attributes->getNamedItem('eId')?->nodeValue;
            if ($eid !== null && $eid !== '') {
                if (isset($eids[$eid])) {
                    $duplicates[] = $eid;
                }
                $eids[$eid] = ($eids[$eid] ?? 0) + 1;
            }
        }

        $this->assertEmpty(
            $duplicates,
            'Identificadores eId duplicados encontrados em estatuto-social.akn.xml: ' . implode(', ', array_unique($duplicates))
        );
        $this->assertGreaterThanOrEqual(70, count($eids), 'Deveriam existir pelo menos 70 eIds estruturados no Estatuto.');
    }

    public function testArticleAndChapterIdsFollowSemanticNamingConvention(): void
    {
        $dom = new DOMDocument();
        $dom->load($this->estatutoXmlPath);

        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('akn', self::AKN_NAMESPACE);

        // Capítulos: cap_1 a cap_5
        $chapters = $xpath->query('//akn:chapter');
        $this->assertCount(5, $chapters, 'Devem existir exatamente 5 capítulos.');

        $expectedCapIndex = 1;
        foreach ($chapters as $chapter) {
            $eid = $chapter->attributes->getNamedItem('eId')?->nodeValue;
            $this->assertSame("cap_{$expectedCapIndex}", $eid, "Capítulo {$expectedCapIndex} deve ter eId 'cap_{$expectedCapIndex}'.");
            $expectedCapIndex++;
        }

        // Artigos: art_1 a art_18
        $articles = $xpath->query('//akn:article');
        $this->assertCount(18, $articles, 'Devem existir exatamente 18 artigos.');

        $expectedArtIndex = 1;
        foreach ($articles as $article) {
            $eid = $article->attributes->getNamedItem('eId')?->nodeValue;
            $this->assertSame("art_{$expectedArtIndex}", $eid, "Artigo {$expectedArtIndex} deve ter eId 'art_{$expectedArtIndex}'.");

            // Validar convenção de parágrafos filhos
            $paragraphs = $xpath->query('akn:paragraph', $article);
            foreach ($paragraphs as $par) {
                $parEid = $par->attributes->getNamedItem('eId')?->nodeValue;
                $this->assertMatchesRegularExpression(
                    '/^art_' . $expectedArtIndex . '_par_[0-9]+$/',
                    (string) $parEid,
                    "Parágrafo do Artigo {$expectedArtIndex} deve seguir padrão 'art_{$expectedArtIndex}_par_X'."
                );
            }

            $expectedArtIndex++;
        }
    }

    public function testEstatutoSocialContainsAllRequiredFrbrMetadata(): void
    {
        $dom = new DOMDocument();
        $dom->load($this->estatutoXmlPath);

        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('akn', self::AKN_NAMESPACE);

        // FRBRWork
        $workDate = $xpath->query('//akn:meta//akn:FRBRWork/akn:FRBRdate/@date')->item(0)?->nodeValue;
        $workCountry = $xpath->query('//akn:meta//akn:FRBRWork/akn:FRBRcountry/@value')->item(0)?->nodeValue;
        $workUri = $xpath->query('//akn:meta//akn:FRBRWork/akn:FRBRuri/@value')->item(0)?->nodeValue;

        $this->assertSame('2002-03-25', $workDate);
        $this->assertSame('bra', $workCountry);
        $this->assertSame('/br/go/guapo/rel/estatuto/ibnp/2002-03-25', $workUri);

        // FRBRExpression
        $exprLang = $xpath->query('//akn:meta//akn:FRBRExpression/akn:FRBRlanguage/@language')->item(0)?->nodeValue;
        $this->assertSame('por', $exprLang);

        // FRBRManifestation
        $format = $xpath->query('//akn:meta//akn:FRBRManifestation/akn:FRBRformat/@value')->item(0)?->nodeValue;
        $this->assertSame('application/akn+xml', $format);
    }
}
