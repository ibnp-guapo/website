<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DTO\LegalDocumentDto;
use App\Services\AkomaNtosoParser;

final class LegalDocController
{
    private AkomaNtosoParser $parser;
    private string $baseDir;

    public function __construct(?AkomaNtosoParser $parser = null, ?string $baseDir = null)
    {
        $this->parser = $parser ?? new AkomaNtosoParser();
        $this->baseDir = $baseDir ?? dirname(__DIR__, 2);
    }

    /**
     * Exibe o visualizador web do Estatuto Social
     */
    public function estatuto(): void
    {
        $filePath = "{$this->baseDir}/data/legal/estatuto-social.akn.xml";
        if (!file_exists($filePath)) {
            http_response_code(404);
            echo "Documento do Estatuto Social não encontrado.";
            return;
        }

        $doc = $this->parser->parseFile($filePath);
        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderViewer($doc, 'estatuto');
    }

    /**
     * Download do arquivo XML do Estatuto Social
     */
    public function downloadEstatutoXml(): void
    {
        $filePath = "{$this->baseDir}/data/legal/estatuto-social.akn.xml";
        if (!file_exists($filePath)) {
            http_response_code(404);
            echo "Arquivo XML do Estatuto Social não encontrado.";
            return;
        }

        header('Content-Type: application/xml; charset=utf-8');
        header('Content-Disposition: attachment; filename="estatuto-social.akn.xml"');
        readfile($filePath);
        exit;
    }

    /**
     * Exibe o visualizador do Regimento Interno ou estado de transição
     */
    public function regimento(): void
    {
        $filePath = "{$this->baseDir}/data/legal/regimento-interno.akn.xml";
        header('Content-Type: text/html; charset=utf-8');

        if (!file_exists($filePath)) {
            echo $this->renderRegimentoInProcess();
            return;
        }

        $doc = $this->parser->parseFile($filePath);
        echo $this->renderViewer($doc, 'regimento');
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
        exit;
    }

    /**
     * Renderiza o visualizador com layout de duas colunas, sumário dinâmico e busca instantânea
     */
    private function renderViewer(LegalDocumentDto $doc, string $currentDoc): string
    {
        $totalArticles = $doc->countArticles();
        $formattedDate = $doc->date ? date('d/m/Y', strtotime($doc->date)) : '25/03/2002';
        
        // Renderizar TOC (Sumário)
        $tocHtml = '';
        foreach ($doc->toc as $capIndex => $item) {
            $tocHtml .= '<div class="mb-4">';
            $tocHtml .= sprintf(
                '<a href="#%s" class="toc-cap-link block font-bold text-xs uppercase tracking-wider text-slate-800 hover:text-ibnp-primary py-1">%s</a>',
                htmlspecialchars($item->eId),
                htmlspecialchars($item->title)
            );
            if (!empty($item->children)) {
                $tocHtml .= '<ul class="pl-2.5 mt-1 border-l-2 border-slate-200 space-y-1 text-xs">';
                foreach ($item->children as $child) {
                    $tocHtml .= sprintf(
                        '<li><a href="#%s" class="toc-art-link block text-slate-600 hover:text-ibnp-primary py-0.5 transition-colors">%s</a></li>',
                        htmlspecialchars($child->eId),
                        htmlspecialchars($child->label)
                    );
                }
                $tocHtml .= '</ul>';
            }
            $tocHtml .= '</div>';
        }

        // Renderizar Artigos e Capítulos
        $bodyHtml = '';
        foreach ($doc->chapters as $chapter) {
            $bodyHtml .= sprintf(
                '<div id="%s" class="chapter-block mb-12 scroll-mt-24">
                    <div class="border-b-2 border-slate-200 pb-3 mb-6">
                        <span class="text-xs font-bold uppercase tracking-widest text-ibnp-primary">%s</span>
                        <h2 class="text-2xl font-black text-slate-900 mt-1">%s</h2>
                    </div>',
                htmlspecialchars($chapter->eId),
                htmlspecialchars($chapter->num),
                htmlspecialchars($chapter->heading)
            );

            foreach ($chapter->articles as $art) {
                $clausesHtml = '';
                if (!empty($art->clauses)) {
                    $clausesHtml .= '<div class="mt-4 space-y-3 pl-4 border-l-2 border-amber-200 text-sm leading-relaxed">';
                    foreach ($art->clauses as $clause) {
                        $prefix = $clause->num !== '' ? "<strong class=\"text-slate-900 font-semibold\">" . htmlspecialchars($clause->num) . "</strong> " : '';
                        $clausesHtml .= sprintf(
                            '<div id="%s" class="clause-item scroll-mt-28">%s<span class="clause-text">%s</span></div>',
                            htmlspecialchars($clause->eId),
                            $prefix,
                            htmlspecialchars($clause->content)
                        );
                    }
                    $clausesHtml .= '</div>';
                }

                $bodyHtml .= sprintf(
                    '<article id="%s" class="article-card mb-8 p-6 rounded-2xl bg-white border border-slate-200 shadow-sm transition-all hover:border-slate-300 scroll-mt-24">
                        <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                            <span class="text-base font-extrabold text-ibnp-dark bg-slate-100 px-3 py-1 rounded-lg">%s</span>
                            <button type="button" onclick="copyPermalink(\'%s\')" class="copy-link-btn inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 hover:text-ibnp-primary transition-colors" title="Copiar link do artigo">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                <span>Link</span>
                            </button>
                        </div>
                        <div class="article-body font-serif text-base sm:text-lg text-slate-700 leading-relaxed">
                            <p class="article-caput">%s</p>
                            %s
                        </div>
                    </article>',
                    htmlspecialchars($art->eId),
                    htmlspecialchars($art->num),
                    htmlspecialchars($art->eId),
                    htmlspecialchars($art->content),
                    $clausesHtml
                );
            }

            $bodyHtml .= '</div>';
        }

        $xmlDownloadUrl = $currentDoc === 'estatuto' ? '/estatuto/xml' : '/regimento/xml';

        return <<<HTML
<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$doc->title} - IBN da Paz de Guapó</title>
    <meta name="description" content="Visualizador interativo do {$doc->title} da Igreja Batista Nacional da Paz de Guapó no padrão OASIS LegalDocML Akoma Ntoso 3.0.">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Merriweather:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
    <style>
        .highlight-pulse {
            animation: pulse-bg 2.5s ease-out;
        }
        @keyframes pulse-bg {
            0% { background-color: #FEF3C7; border-color: #F59E0B; }
            70% { background-color: #FEF3C7; border-color: #F59E0B; }
            100% { background-color: #FFFFFF; }
        }
        mark.search-highlight {
            background-color: #EFA162;
            color: #1E293B;
            padding: 0.1rem 0.25rem;
            border-radius: 0.2rem;
            font-weight: 600;
        }
    </style>
</head>
<body class="h-full flex flex-col text-slate-800 antialiased font-sans">
    <!-- Header Principal -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <span class="w-9 h-9 rounded-lg bg-ibnp-primary flex items-center justify-center text-white font-black text-lg shadow-sm">P</span>
                <span class="font-extrabold text-lg text-slate-900 tracking-tight">IBN da Paz <span class="text-ibnp-primary font-bold">Guapó</span></span>
            </a>
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600">
                <a href="/" class="hover:text-ibnp-primary transition">Início</a>
                <a href="/programacao" class="hover:text-ibnp-primary transition">Programação</a>
                <a href="/estatuto" class="text-ibnp-primary font-bold border-b-2 border-ibnp-primary pb-0.5">Estatuto</a>
                <a href="/regimento" class="hover:text-ibnp-primary transition">Regimento</a>
                <a href="/sobre" class="hover:text-ibnp-primary transition">Sobre</a>
                <a href="/contato" class="hover:text-ibnp-primary transition">Contato</a>
            </nav>
        </div>
    </header>

    <!-- Barra de Contexto Legal e Ações -->
    <div class="bg-slate-900 text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2 flex-wrap">
                        <span class="bg-orange-600/30 text-orange-300 text-xs font-semibold px-2.5 py-0.5 rounded-full border border-orange-500/30">OASIS Akoma Ntoso 3.0</span>
                        <span class="bg-slate-800 text-slate-300 text-xs font-medium px-2.5 py-0.5 rounded-full">Cartório 2º Ofício de Guapó • {$formattedDate}</span>
                        <span class="bg-slate-800 text-slate-300 text-xs font-medium px-2.5 py-0.5 rounded-full">{$totalArticles} Artigos</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">{$doc->title}</h1>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl font-light">{$doc->subtitle}</p>
                </div>
                <div class="flex items-center gap-3 flex-wrap">
                    <a href="{$xmlDownloadUrl}" download class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold transition border border-slate-700 shadow-xs">
                        <svg class="w-4 h-4 text-ibnp-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        <span>Baixar XML Akoma Ntoso</span>
                    </a>
                    <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-ibnp-primary hover:bg-orange-700 text-white text-xs font-bold transition shadow-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        <span>Imprimir / PDF</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Conteúdo Principal em 2 Colunas -->
    <div class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Coluna Esquerda: Sumário e Busca Instantânea -->
            <aside class="lg:col-span-4 bg-white rounded-2xl border border-slate-200 p-5 shadow-xs sticky top-20 max-h-[calc(100vh-6rem)] overflow-y-auto">
                <div class="mb-4">
                    <label for="search-input" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        🔍 Buscar no documento
                    </label>
                    <div class="relative">
                        <input type="text" id="search-input" placeholder="Ex: diretoria, eleição, Guapó..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-ibnp-primary focus:border-transparent bg-slate-50 transition">
                        <span id="search-count" class="hidden absolute right-2.5 top-2 text-[10px] font-bold text-slate-400 bg-slate-200 px-1.5 py-0.5 rounded">0</span>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-4">
                    <h2 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-3">Sumário Geral</h2>
                    <nav id="toc-nav" class="space-y-2">
                        {$tocHtml}
                    </nav>
                </div>
            </aside>

            <!-- Coluna Direita: Leitor Jurídico -->
            <main class="lg:col-span-8">
                <div id="document-body">
                    {$bodyHtml}
                </div>
                <div id="no-search-results" class="hidden text-center py-12 bg-white rounded-2xl border border-slate-200 p-8">
                    <p class="text-slate-500 text-sm font-medium">Nenhum artigo ou parágrafo correspondeu à sua busca.</p>
                </div>
            </main>

        </div>
    </div>

    <!-- Toast de Feedback para Permalink -->
    <div id="toast-copied" class="fixed bottom-6 right-6 bg-slate-900 text-white px-4 py-2.5 rounded-xl shadow-lg text-xs font-bold transition-opacity duration-300 opacity-0 pointer-events-none flex items-center gap-2 z-50">
        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span>Link do artigo copiado para a área de transferência!</span>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 text-xs py-8 border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <p class="font-semibold text-slate-200">Igreja Batista Nacional da Paz de Guapó</p>
                <p class="text-slate-400">CNPJ: 02.930.019/0001-62 • Fundada em 14/01/1999 • Filiada à CBN e ORMIBAN Goiás</p>
            </div>
            <p>&copy; 2026 IBN da Paz de Guapó. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Script de Interatividade (Busca em tempo real, permalinks e pulso) -->
    <script>
        // Função para copiar o permalink do artigo
        function copyPermalink(eId) {
            const url = window.location.origin + window.location.pathname + '#' + eId;
            navigator.clipboard.writeText(url).then(() => {
                showToast();
                history.pushState(null, null, '#' + eId);
                highlightElement(eId);
            });
        }

        function showToast() {
            const toast = document.getElementById('toast-copied');
            toast.classList.remove('opacity-0');
            toast.classList.add('opacity-100');
            setTimeout(() => {
                toast.classList.remove('opacity-100');
                toast.classList.add('opacity-0');
            }, 2500);
        }

        function highlightElement(id) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.remove('highlight-pulse');
                void el.offsetWidth; // trigger reflow
                el.classList.add('highlight-pulse');
            }
        }

        // Destaque inicial ao carregar com âncora
        window.addEventListener('DOMContentLoaded', () => {
            if (window.location.hash) {
                const targetId = window.location.hash.substring(1);
                setTimeout(() => highlightElement(targetId), 200);
            }
        });

        // Busca textual instantânea nos artigos
        const searchInput = document.getElementById('search-input');
        const searchCount = document.getElementById('search-count');
        const articles = document.querySelectorAll('.article-card');
        const noResults = document.getElementById('no-search-results');

        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.trim().toLowerCase();
            let matchCount = 0;

            if (query === '') {
                searchCount.classList.add('hidden');
                noResults.classList.add('hidden');
                articles.forEach(art => {
                    art.classList.remove('hidden');
                    resetHighlights(art);
                });
                return;
            }

            articles.forEach(art => {
                const text = art.textContent.toLowerCase();
                if (text.includes(query)) {
                    art.classList.remove('hidden');
                    matchCount++;
                    highlightMatches(art, query);
                } else {
                    art.classList.add('hidden');
                    resetHighlights(art);
                }
            });

            searchCount.textContent = matchCount;
            searchCount.classList.remove('hidden');
            if (matchCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });

        function resetHighlights(el) {
            el.querySelectorAll('mark.search-highlight').forEach(mark => {
                const parent = mark.parentNode;
                parent.replaceChild(document.createTextNode(mark.textContent), mark);
                parent.normalize();
            });
        }

        function highlightMatches(el, query) {
            resetHighlights(el);
            const walker = document.createTreeWalker(el, NodeFilter.SHOW_TEXT, null, false);
            const textNodes = [];
            let node;
            while (node = walker.nextNode()) {
                if (node.parentNode.nodeName !== 'SCRIPT' && node.parentNode.nodeName !== 'BUTTON') {
                    textNodes.push(node);
                }
            }

            const regex = new RegExp('(' + query.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&') + ')', 'gi');
            textNodes.forEach(textNode => {
                const val = textNode.nodeValue;
                if (regex.test(val)) {
                    const span = document.createElement('span');
                    span.innerHTML = val.replace(regex, '<mark class="search-highlight">$1</mark>');
                    textNode.parentNode.replaceChild(span, textNode);
                }
            });
        }
    </script>
</body>
</html>
HTML;
    }

    /**
     * Renderiza tela amigável para o Regimento Interno durante o período de transcrição (Issue #4)
     */
    private function renderRegimentoInProcess(): string
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regimento Interno - IBN da Paz de Guapó</title>
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="h-full flex flex-col text-slate-800 antialiased font-sans">
    <header class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <span class="w-9 h-9 rounded-lg bg-ibnp-primary flex items-center justify-center text-white font-black text-lg shadow-sm">P</span>
                <span class="font-extrabold text-lg text-slate-900 tracking-tight">IBN da Paz <span class="text-ibnp-primary font-bold">Guapó</span></span>
            </a>
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600">
                <a href="/" class="hover:text-ibnp-primary transition">Início</a>
                <a href="/programacao" class="hover:text-ibnp-primary transition">Programação</a>
                <a href="/estatuto" class="hover:text-ibnp-primary transition">Estatuto</a>
                <a href="/regimento" class="text-ibnp-primary font-bold border-b-2 border-ibnp-primary pb-0.5">Regimento</a>
                <a href="/sobre" class="hover:text-ibnp-primary transition">Sobre</a>
                <a href="/contato" class="hover:text-ibnp-primary transition">Contato</a>
            </nav>
        </div>
    </header>

    <main class="flex-1 max-w-4xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-16 flex items-center justify-center">
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-sm text-center">
            <div class="w-16 h-16 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center mx-auto mb-6 text-2xl">
                📜
            </div>
            <span class="text-xs font-bold uppercase tracking-widest text-amber-600 bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
                Documento em Transcrição Semântica
            </span>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 mt-4 mb-4 tracking-tight">
                Regimento Interno
            </h1>
            <p class="text-slate-600 text-base max-w-xl mx-auto mb-8 leading-relaxed">
                O texto integral do Regimento Interno da Igreja Batista Nacional da Paz de Guapó está atualmente sendo transcrito para o padrão semântico internacional <strong>OASIS LegalDocML Akoma Ntoso 3.0</strong> (Issue #4).
            </p>
            <div class="flex items-center justify-center gap-4 flex-wrap">
                <a href="/estatuto" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-ibnp-primary text-white text-sm font-bold hover:bg-orange-700 transition shadow-sm">
                    <span>Consultar Estatuto Social</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
                <a href="/" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-bold hover:bg-slate-200 transition">
                    Voltar ao Início
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-slate-400 text-xs py-8 border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <p class="font-semibold text-slate-200">Igreja Batista Nacional da Paz de Guapó</p>
                <p class="text-slate-400">CNPJ: 02.930.019/0001-62 • Fundada em 14/01/1999 • Filiada à CBN e ORMIBAN Goiás</p>
            </div>
            <p>&copy; 2026 IBN da Paz de Guapó. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
HTML;
    }
}
