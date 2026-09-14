<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DTO\LegalDocumentDto;
use App\Services\AkomaNtosoParser;
use App\Services\BladeViewRenderer;

final class LegalDocController
{
    private AkomaNtosoParser $parser;
    private BladeViewRenderer $renderer;
    private string $baseDir;

    public function __construct(
        ?AkomaNtosoParser $parser = null,
        ?BladeViewRenderer $renderer = null,
        ?string $baseDir = null
    ) {
        $this->parser = $parser ?? new AkomaNtosoParser();
        $this->baseDir = $baseDir ?? dirname(__DIR__, 2);

        $viewsPath = "{$this->baseDir}/views";
        $cachePath = "{$this->baseDir}/storage/cache/views";
        $this->renderer = $renderer ?? new BladeViewRenderer($viewsPath, $cachePath);
    }

    /**
     * Exibe o visualizador web do Estatuto Social
     */
    public function estatuto(): void
    {
        $filePath = "{$this->baseDir}/data/legal/estatuto-social.akn.xml";
        if (!file_exists($filePath)) {
            http_response_code(404);
            header('Content-Type: text/plain; charset=utf-8');
            echo "Documento do Estatuto Social não encontrado.";
            return;
        }

        $doc = $this->parser->parseFile($filePath);
        $totalArticles = $doc->countArticles();
        $formattedDate = $doc->date ? date('d/m/Y', strtotime($doc->date)) : '25/03/2002';
        $xmlDownloadUrl = '/estatuto/xml';

        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderer->render('pages.legal.estatuto', [
            'doc' => $doc,
            'currentDoc' => 'estatuto',
            'currentRoute' => '/estatuto',
            'formattedDate' => $formattedDate,
            'totalArticles' => $totalArticles,
            'xmlDownloadUrl' => $xmlDownloadUrl,
        ]);
    }

    /**
     * Download do arquivo XML do Estatuto Social
     */
    public function downloadEstatutoXml(): void
    {
        $filePath = "{$this->baseDir}/data/legal/estatuto-social.akn.xml";
        if (!file_exists($filePath)) {
            http_response_code(404);
            header('Content-Type: text/plain; charset=utf-8');
            echo "Arquivo XML do Estatuto Social não encontrado.";
            return;
        }

        header('Content-Type: application/xml; charset=utf-8');
        header('Content-Disposition: attachment; filename="estatuto-social.akn.xml"');
        readfile($filePath);
        return;
    }

    /**
     * Exibe o visualizador do Regimento Interno ou estado de transição
     */
    public function regimento(): void
    {
        $filePath = "{$this->baseDir}/data/legal/regimento-interno.akn.xml";
        header('Content-Type: text/html; charset=utf-8');

        if (!file_exists($filePath)) {
            echo $this->renderer->render('pages.legal.regimento', [
                'doc' => null,
                'currentDoc' => 'regimento',
                'currentRoute' => '/regimento',
                'inProcess' => true,
                'xmlDownloadUrl' => '/regimento/xml',
            ]);
            return;
        }

        $doc = $this->parser->parseFile($filePath);
        $totalArticles = $doc->countArticles();
        $formattedDate = $doc->date ? date('d/m/Y', strtotime($doc->date)) : '25/03/2002';

        echo $this->renderer->render('pages.legal.regimento', [
            'doc' => $doc,
            'currentDoc' => 'regimento',
            'currentRoute' => '/regimento',
            'formattedDate' => $formattedDate,
            'totalArticles' => $totalArticles,
            'inProcess' => false,
            'xmlDownloadUrl' => '/regimento/xml',
        ]);
    }

    /**
     * Download do XML do Regimento Interno
     */
    public function downloadRegimentoXml(): void
    {
        $filePath = "{$this->baseDir}/data/legal/regimento-interno.akn.xml";
        if (!file_exists($filePath)) {
            http_response_code(404);
            header('Content-Type: text/plain; charset=utf-8');
            echo "Arquivo XML do Regimento Interno ainda não disponível para download.";
            return;
        }

        header('Content-Type: application/xml; charset=utf-8');
        header('Content-Disposition: attachment; filename="regimento-interno.akn.xml"');
        readfile($filePath);
        return;
    }
}
