@extends('layouts.app')

@section('title', ($doc ? $doc->title : 'Regimento Interno') . ' - IBNP')
@section('meta_description', $doc ? ('Visualizador interativo do ' . $doc->title . ' da Igreja Batista Nacional da Paz de Guapó, com busca e texto integral.') : 'O texto integral do Regimento Interno da Igreja Batista Nacional da Paz de Guapó para consulta pública e transparência institucional.')

@if ($doc)
    @section('head')
        <style>
            .highlight-pulse {
                animation: pulse-bg 2.5s ease-out;
            }
            @keyframes pulse-bg {
                0% { background-color: #F1D6A9; border-color: #a83900; }
                70% { background-color: #F1D6A9; border-color: #a83900; }
                100% { background-color: #FFFFFF; }
            }
            mark.search-highlight {
                background-color: #F1D6A9;
                color: #111c2d;
                padding: 0.1rem 0.25rem;
                border-radius: 0.25rem;
                font-weight: 700;
            }
        </style>
    @endsection
@endif

@section('content')
    @if (!$doc)
        <!-- Apresentação Institucional e Diretrizes Regimentais (Spec 14) -->
        <main class="flex-1 max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="bg-surface-pure rounded-3xl p-6 sm:p-10 md:p-12 border border-outline-variant/30 elevation-warm-1">
                <!-- Cabeçalho -->
                <div class="flex items-center gap-2 mb-4 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-cream-warm/50 text-secondary border border-outline-variant/50 text-xs font-bold">
                        <span class="material-symbols-outlined text-[14px]">verified</span>
                        <span>Documento Oficial Complementar</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-cream-light text-on-surface border border-outline-variant/40 text-xs font-medium">
                        <span class="material-symbols-outlined text-[14px] text-secondary">gavel</span>
                        <span>Vinculado ao Estatuto Social</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-cream-light text-on-surface border border-outline-variant/40 text-xs font-medium">
                        <span class="material-symbols-outlined text-[14px] text-primary">apartment</span>
                        <span>Guapó - GO</span>
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl font-extrabold text-on-surface tracking-tight mb-4">
                    Regimento Interno e Diretrizes Regimentais
                </h1>

                <p class="text-text-muted text-sm sm:text-base leading-relaxed mb-8">
                    O Regimento Interno da <strong class="text-on-surface font-semibold">Igreja Batista Nacional da Paz de Guapó</strong> (CNPJ 02.930.019/0001-62) é a norma disciplinar interna que complementa e regulamenta os preceitos fundamentais estabelecidos em seu Estatuto Social registrado, norteando a ordem dos cultos, as atribuições ministeriais e o funcionamento dos órgãos diretivos.
                </p>

                <!-- Estrutura Regimental em Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 text-xs sm:text-sm">
                    <div class="p-5 rounded-2xl bg-surface-cream-light border border-outline-variant/30">
                        <div class="flex items-center gap-2 mb-2 text-secondary font-bold">
                            <span class="material-symbols-outlined text-[20px]">groups</span>
                            <span class="text-xs uppercase tracking-wider">1. Assembleia Geral Soberana</span>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">
                            Instância máxima deliberativa composta pelos membros em comunhão regular, responsável por aprovar contas, alterações estatutárias e decisões fundamentais da comunidade.
                        </p>
                    </div>

                    <div class="p-5 rounded-2xl bg-surface-cream-light border border-outline-variant/30">
                        <div class="flex items-center gap-2 mb-2 text-primary font-bold">
                            <span class="material-symbols-outlined text-[20px]">shield_person</span>
                            <span class="text-xs uppercase tracking-wider">2. Diretoria Executiva</span>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">
                            Órgão representativo eleito para zelar pela integridade jurídica, administrativa e patrimonial da igreja, cumprindo as deliberações assembleares e preceitos estatutários.
                        </p>
                    </div>

                    <div class="p-5 rounded-2xl bg-surface-cream-light border border-outline-variant/30">
                        <div class="flex items-center gap-2 mb-2 text-secondary font-bold">
                            <span class="material-symbols-outlined text-[20px]">menu_book</span>
                            <span class="text-xs uppercase tracking-wider">3. Ministério Pastoral &amp; Liturgia</span>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">
                            Responsável pelo ensino das Escrituras, administração dos atos de culto (quarta-feira e domingo), santa ceia, batismo por imersão e aconselhamento dos fiéis.
                        </p>
                    </div>

                    <div class="p-5 rounded-2xl bg-surface-cream-light border border-outline-variant/30">
                        <div class="flex items-center gap-2 mb-2 text-primary font-bold">
                            <span class="material-symbols-outlined text-[20px]">balance</span>
                            <span class="text-xs uppercase tracking-wider">4. Conselho Fiscal &amp; Transparência</span>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">
                            Comissão autônoma eleita para auditoria e fiscalização periódica das receitas, despesas e relatórios contábeis, garantindo lisura e prestação de contas aos membros.
                        </p>
                    </div>
                </div>

                <!-- Nota Institucional de Acesso e Contato -->
                <div class="p-5 rounded-2xl bg-surface-cream-warm/30 border border-outline-variant/40 mb-8">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary text-[22px] mt-0.5">info</span>
                        <div>
                            <strong class="text-xs font-bold text-on-surface block">Acesso e Consulta Formal</strong>
                            <p class="text-xs text-text-muted leading-relaxed mt-1">
                                O texto integral e os livros de atas regimentais estão sob custódia da secretaria geral em nossa sede. Para esclarecimentos regulamentares ou solicitação de certidões regimentais, contate a secretaria através do e-mail oficial <a href="mailto:contato@ibnpguapo.org.br" class="text-primary hover:underline font-bold">contato@ibnpguapo.org.br</a>.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex items-center gap-4 flex-wrap">
                    <a href="/estatuto" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-primary text-on-primary text-xs sm:text-sm font-bold shadow-md hover:bg-secondary-container transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">description</span>
                        <span>Consultar Estatuto Social Oficial</span>
                    </a>
                    <a href="/contato" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-surface-pure border border-outline-variant/50 text-on-surface text-xs sm:text-sm font-bold hover:border-secondary hover:text-secondary transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">mail</span>
                        <span>Falar com a Secretaria</span>
                    </a>
                    <a href="/" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-surface-pure border border-secondary text-secondary text-xs sm:text-sm font-bold hover:bg-secondary-container/10 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">home</span>
                        <span>Voltar ao Início</span>
                    </a>
                </div>
            </div>
        </main>
    @else
        <!-- Visualizador Ativo do Regimento Interno -->
        <div class="bg-gradient-to-b from-surface-cream-light via-[#FFFDF9] to-surface-cream-light border-b border-outline-variant/30 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2 mb-3 flex-wrap">
                            <span class="inline-flex items-center gap-1.5 bg-surface-cream-warm/50 text-secondary border border-outline-variant/50 text-xs font-bold px-3 py-1 rounded-full">
                                <span class="material-symbols-outlined text-[14px]">verified</span>
                                <span>Documento Oficial</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 bg-surface-cream-light text-on-surface border border-outline-variant/40 text-xs font-medium px-3 py-1 rounded-full">
                                <span class="material-symbols-outlined text-[14px] text-secondary">verified</span>
                                <span>Assembleia Geral Extraordinária • {{ $formattedDate }}</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 bg-surface-cream-light text-on-surface border border-outline-variant/40 text-xs font-medium px-3 py-1 rounded-full">
                                <span class="material-symbols-outlined text-[14px] text-primary">description</span>
                                <span>{{ $totalArticles }} Artigos</span>
                            </span>
                        </div>

                        <h1 class="text-2xl sm:text-4xl font-extrabold text-on-surface tracking-tight">
                            {{ $doc->title }}
                        </h1>
                        @if (!empty($doc->subtitle))
                            <p class="text-xs sm:text-sm text-text-muted mt-2 max-w-2xl leading-relaxed">
                                {{ $doc->subtitle }}
                            </p>
                        @endif
                    </div>

                    <div class="flex items-center gap-3 flex-wrap">
                        <a href="{{ $xmlDownloadUrl }}" download class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-surface-pure text-on-surface text-xs font-bold border border-outline-variant/40 shadow-sm hover:border-secondary hover:text-secondary transition-all active:scale-95">
                            <span class="material-symbols-outlined text-[18px] text-secondary">data_object</span>
                            <span>Baixar XML</span>
                        </a>
                        <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-on-primary text-xs font-bold shadow-md hover:bg-secondary-container transition-all active:scale-95">
                            <span class="material-symbols-outlined text-[18px]">print</span>
                            <span>Imprimir / PDF</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <aside class="lg:col-span-4 bg-surface-pure rounded-3xl border border-outline-variant/30 p-6 elevation-warm-1 lg:sticky lg:top-24 lg:max-h-[calc(100vh-8rem)] lg:overflow-y-auto">
                    <div class="mb-5">
                        <label for="search-input" class="block text-xs font-bold text-on-surface uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-secondary text-[16px]">search</span>
                            <span>Buscar no documento</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="search-input" placeholder="Ex: diretoria, ministério..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-outline-variant/40 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent bg-surface-cream-light text-on-surface transition">
                            <span id="search-count" class="hidden absolute right-3 top-2.5 text-[10px] font-bold text-on-surface bg-surface-cream-warm px-2 py-0.5 rounded-md">0</span>
                        </div>
                    </div>

                    <button type="button" id="toc-mobile-toggle" class="w-full lg:hidden inline-flex items-center justify-between gap-2 px-4 py-3 rounded-xl bg-surface-cream-light border border-outline-variant/40 text-on-surface text-xs font-bold mb-4 transition-colors hover:border-secondary" aria-expanded="false" aria-controls="toc-container">
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-secondary text-[16px]">menu_book</span>
                            <span>Sumário Geral</span>
                        </span>
                        <span id="toc-toggle-icon" class="material-symbols-outlined text-[20px] transition-transform duration-300">expand_more</span>
                    </button>

                    <div id="toc-container" class="hidden lg:block border-t border-outline-variant/30 pt-4">
                        <h2 class="text-xs font-bold uppercase tracking-widest text-text-muted mb-3">Sumário Geral</h2>
                        <nav id="toc-nav" class="space-y-3">
                            @foreach ($doc->toc as $item)
                                <div class="mb-3">
                                    <a href="#{{ $item->eId }}" class="toc-cap-link block font-bold text-xs uppercase tracking-wider text-on-surface hover:text-primary py-1 transition-colors">
                                        {{ $item->title }}
                                    </a>
                                    @if (!empty($item->children))
                                        <ul class="pl-3 mt-1 border-l-2 border-outline-variant/40 space-y-1 text-xs">
                                            @foreach ($item->children as $child)
                                                <li>
                                                    <a href="#{{ $child->eId }}" class="toc-art-link block text-text-muted hover:text-primary py-0.5 transition-colors">
                                                        {{ $child->label }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </nav>
                    </div>
                </aside>

                <main class="lg:col-span-8">
                    <div id="document-body">
                        @foreach ($doc->chapters as $chapter)
                            <div id="{{ $chapter->eId }}" class="chapter-block mb-12 scroll-mt-28">
                                <div class="border-b-2 border-outline-variant/40 pb-3 mb-6">
                                    <span class="text-xs font-bold uppercase tracking-widest text-primary">{{ $chapter->num }}</span>
                                    <h2 class="text-2xl font-extrabold text-on-surface mt-1">{{ $chapter->heading }}</h2>
                                </div>

                                @foreach ($chapter->articles as $art)
                                    <article id="{{ $art->eId }}" class="article-card mb-8 p-6 sm:p-8 rounded-3xl bg-surface-pure border border-outline-variant/30 elevation-warm-1 transition-all hover:border-secondary scroll-mt-28">
                                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-outline-variant/20">
                                            <span class="text-sm font-extrabold text-on-surface bg-surface-cream-warm/40 border border-outline-variant/40 px-3.5 py-1 rounded-xl">
                                                {{ $art->num }}
                                            </span>
                                            <button type="button" onclick="copyPermalink('{{ $art->eId }}')" class="copy-link-btn inline-flex items-center gap-1.5 text-xs font-semibold text-text-muted hover:text-primary transition-colors cursor-pointer" title="Copiar link do artigo">
                                                <span class="material-symbols-outlined text-[16px]">link</span>
                                                <span>Link</span>
                                            </button>
                                        </div>
                                        <div class="article-body font-serif text-base sm:text-lg text-on-surface/90 leading-relaxed">
                                            <p class="article-caput">{{ $art->content }}</p>
                                            @if (!empty($art->clauses))
                                                <div class="mt-4 space-y-3 pl-4 border-l-2 border-secondary/40 text-sm font-sans leading-relaxed">
                                                    @foreach ($art->clauses as $clause)
                                                        <div id="{{ $clause->eId }}" class="clause-item scroll-mt-28">
                                                            @if ($clause->num !== '')
                                                                <strong class="text-on-surface font-bold">{{ $clause->num }}</strong>
                                                            @endif
                                                            <span class="clause-text text-text-muted">{{ $clause->content }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <div id="no-search-results" class="hidden text-center py-12 bg-surface-pure rounded-3xl border border-outline-variant/30 p-8">
                        <p class="text-text-muted text-sm font-medium">Nenhum artigo ou parágrafo correspondeu à sua busca.</p>
                    </div>
                </main>
            </div>
        </div>

        <div id="toast-copied" class="fixed bottom-6 right-6 bg-on-surface text-surface-pure px-5 py-3 rounded-2xl shadow-xl text-xs font-bold transition-opacity duration-300 opacity-0 pointer-events-none flex items-center gap-2.5 z-50">
            <span class="material-symbols-outlined text-emerald-400 text-[18px]">check_circle</span>
            <span>Link do artigo copiado para a área de transferência!</span>
        </div>

        <script>
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
                    void el.offsetWidth;
                    el.classList.add('highlight-pulse');
                }
            }

            window.addEventListener('DOMContentLoaded', () => {
                if (window.location.hash) {
                    const targetId = window.location.hash.substring(1);
                    setTimeout(() => highlightElement(targetId), 200);
                }
            });

            const searchInput = document.getElementById('search-input');
            const searchCount = document.getElementById('search-count');
            const articles = document.querySelectorAll('.article-card');
            const noResults = document.getElementById('no-search-results');

            const tocToggle = document.getElementById('toc-mobile-toggle');
            const tocContainer = document.getElementById('toc-container');
            const tocToggleIcon = document.getElementById('toc-toggle-icon');

            tocToggle.addEventListener('click', () => {
                const isHidden = tocContainer.classList.toggle('hidden');
                tocToggle.setAttribute('aria-expanded', String(!isHidden));
                tocToggleIcon.classList.toggle('rotate-180', !isHidden);
            });

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
    @endif
@endsection
