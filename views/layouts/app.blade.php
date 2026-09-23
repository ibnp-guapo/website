<!DOCTYPE html>
<html lang="pt-BR" class="h-full scroll-smooth overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IBNP - Um Lugar de Paz, Comunhão e Adoração')</title>
    <meta name="description" content="@yield('meta_description', 'Portal oficial da IBNP em Guapó-GO. Comunidade, educação infantil e impacto social. Encontros abertos às quartas e domingos às 19:30.')">

    <!-- Google Fonts Preconnect & Display Swap (Ad Grants Performance) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="/assets/css/app.css?v=1.0.5" as="style">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" />
    <!-- Plus Jakarta Sans font family -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Design System CSS -->
    <link rel="stylesheet" href="/assets/css/app.css?v=1.0.5">
    <link rel="icon" type="image/png" href="/assets/images/logo-ibnp.png">

    @yield('head')
</head>
<body class="bg-surface-cream-light text-on-surface font-sans antialiased min-h-screen flex flex-col selection:bg-secondary-container selection:text-on-secondary-container overflow-x-hidden">

    <!-- TOP APP BAR (Stitch Design Component) -->
    <header class="sticky top-0 z-50 bg-surface-cream-light/95 backdrop-blur-md shadow-sm border-b border-outline-variant/30 transition-all w-full max-w-full overflow-hidden">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            <!-- Brand Logo & Identity -->
            <a href="/" class="flex items-center gap-2.5 sm:gap-3 group shrink-0 mr-2 xl:mr-4">
                <div class="w-10 h-10 sm:w-11 sm:h-11 shrink-0 rounded-xl bg-white p-1 flex items-center justify-center shadow-xs border border-outline-variant/40 group-hover:scale-105 transition-transform duration-200 overflow-hidden" style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; max-width: 44px; max-height: 44px;">
                    <img src="/assets/images/logo-ibnp.png" alt="Logo IBNP" width="44" height="44" class="w-full h-full object-contain" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                </div>
                <div class="flex flex-col">
                    <span class="text-lg sm:text-xl font-black text-on-surface tracking-tight leading-none whitespace-nowrap">IBNP</span>
                    <span class="text-[0.625rem] text-text-muted font-medium tracking-wide hidden 2xl:block whitespace-nowrap">Comunidade • Educação • Impacto Social</span>
                </div>
            </a>

            <!-- Web Desktop Navigation Links (Compacto e responsivo, mantendo CTA sempre visível) -->
            <nav class="hidden xl:flex items-center justify-center gap-2 xl:gap-3 2xl:gap-5 text-xs 2xl:text-sm font-semibold flex-1 px-2">
                <a href="/" class="whitespace-nowrap pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Início</a>
                <a href="/programacao" class="whitespace-nowrap pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/programacao' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Programação</a>
                <a href="/#iniciativas" class="whitespace-nowrap pb-1 transition-all duration-200 text-on-surface hover:text-primary">Iniciativas</a>
                <a href="/estatuto" class="whitespace-nowrap pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/estatuto' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Estatuto</a>
                <a href="/regimento" class="whitespace-nowrap pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/regimento' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Regimento</a>
                <a href="/sobre" class="whitespace-nowrap pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/sobre' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Sobre Nós</a>
                <a href="https://social.ibnpguapo.org.br/" target="_blank" rel="noopener noreferrer" class="whitespace-nowrap pb-1 transition-all duration-200 text-on-surface hover:text-primary inline-flex items-center gap-1" title="Ação Social - Escola Social de Guapó (abre em nova aba)">
                    <span>Ação Social</span>
                    <span class="material-symbols-outlined text-[13px] text-text-muted">open_in_new</span>
                </a>
                <a href="/contato" class="whitespace-nowrap pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/contato' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Contato</a>
            </nav>

            <!-- Trailing Action: Planeje sua Visita & Como Chegar (Ad Grants High Priority CTA com shrink-0) -->
            <div class="flex items-center gap-3 shrink-0 ml-auto xl:ml-3 2xl:ml-6 xl:pl-3 2xl:pl-6 xl:border-l xl:border-outline-variant/30">
                <a href="/programacao" class="hidden sm:inline-flex items-center gap-1.5 bg-primary text-on-primary text-xs font-bold px-3.5 py-2.5 rounded-xl hover:bg-secondary-container transition-all duration-200 shadow-sm active:scale-95 whitespace-nowrap shrink-0">
                    <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                    <span>Planeje sua Visita</span>
                </a>

                <!-- Mobile & Tablet Menu Toggle Button (visível abaixo de 1280px) -->
                <button type="button" aria-label="Abrir menu de navegação" class="xl:hidden p-2 rounded-lg text-on-surface hover:bg-surface-cream-warm transition-colors" onclick="toggleMobileMenu()">
                    <span class="material-symbols-outlined text-[26px]">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile & Tablet Navigation Drawer Collapse -->
        <div id="mobile-menu-drawer" class="hidden xl:hidden border-t border-outline-variant/30 bg-surface-cream-light px-4 py-4 space-y-2">
            <a href="/" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Início</a>
            <a href="/programacao" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/programacao' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Programação</a>
            <a href="/#iniciativas" class="block py-2 text-sm font-semibold text-on-surface hover:text-primary">Iniciativas</a>
            <a href="/estatuto" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/estatuto' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Estatuto Social</a>
            <a href="/regimento" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/regimento' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Regimento Interno</a>
            <a href="/sobre" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/sobre' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Sobre Nós</a>
            <a href="https://social.ibnpguapo.org.br/" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between py-2 text-sm font-semibold text-on-surface hover:text-primary" title="Ação Social - Escola Social de Guapó (abre em nova aba)">
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px] text-secondary">volunteer_activism</span>
                    <span>Ação Social (Escola Social)</span>
                </span>
                <span class="material-symbols-outlined text-[16px] text-text-muted">open_in_new</span>
            </a>
            <a href="/contato" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/contato' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Contato</a>
            <div class="pt-3 border-t border-outline-variant/30 flex flex-col gap-2">
                <a href="/programacao" class="flex items-center justify-center gap-1.5 w-full bg-primary text-on-primary py-3 rounded-xl text-xs font-bold shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                    <span>Planeje sua Visita (Encontros)</span>
                </a>
                <a href="https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20informa%C3%A7%C3%B5es%20e%20atendimento%20pastoral%20na%20IBNP." target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-1.5 w-full bg-[#25D366] text-white py-3 rounded-xl text-xs font-bold shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">chat</span>
                    <span>Atendimento Pastoral via WhatsApp</span>
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN CANVAS -->
    <main class="flex-grow w-full max-w-full overflow-hidden">
        @yield('content')
    </main>

    <!-- INSTITUTIONAL FOOTER (Stitch Component Execution) -->
    <footer class="bg-surface-container-low border-t border-outline-variant/30 text-on-surface mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col gap-8">
            <!-- Top Institutional Row -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pb-4">
                <!-- Church Identity Column -->
                <div class="md:col-span-5 space-y-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 shrink-0 rounded-xl bg-white p-1 flex items-center justify-center shadow-xs border border-outline-variant/30 overflow-hidden" style="width: 36px; height: 36px; min-width: 36px; min-height: 36px; max-width: 36px; max-height: 36px;">
                            <img src="/assets/images/logo-ibnp.png" alt="Logo IBNP" width="36" height="36" class="w-full h-full object-contain" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                        <span class="text-base font-bold text-on-surface">IBNP</span>
                    </div>
                    <p class="text-xs text-text-muted leading-relaxed">
                        <strong class="text-on-surface font-semibold">IBNP</strong> (Igreja Batista Nacional da Paz de Guapó). Uma comunidade de fé, acolhimento e compromisso com o Evangelho da Graça, mantenedora legal da Escola Social de Guapó, filiada à <a href="https://cbn.org.br/" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline font-medium" title="Convenção Batista Nacional (abre em nova aba)">Convenção Batista Nacional (CBN)</a> e à <a href="https://ormiban.org.br/site/" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline font-medium" title="Ordem dos Ministros Batistas Nacionais (abre em nova aba)">ORMIBAN Goiás</a>.
                    </p>
                    <div class="text-[11px] font-semibold text-text-muted leading-relaxed space-y-0.5">
                        <span class="block text-secondary font-bold">CNPJ: 02.930.019/0001-62 • Fundação em 14/01/1999</span>
                        <span class="block">Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro, Guapó – GO, CEP 75350-000</span>
                        <span class="block pt-0.5">E-mail: <a href="mailto:contato@ibnpguapo.org.br" class="text-primary hover:underline font-medium">contato@ibnpguapo.org.br</a></span>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="md:col-span-4 space-y-3">
                    <span class="text-xs font-bold text-on-surface uppercase tracking-wider block">Navegação Rápida</span>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/">Início</a>
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/programacao">Programação</a>
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/estatuto">Estatuto Social</a>
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/regimento">Regimento Interno</a>
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/sobre">Sobre Nós</a>
                        <a class="text-text-muted hover:text-primary transition-colors duration-200 inline-flex items-center gap-1" href="https://social.ibnpguapo.org.br/" target="_blank" rel="noopener noreferrer" title="Ação Social - Escola Social de Guapó (abre em nova aba)">
                            <span>Escola Social</span>
                            <span class="material-symbols-outlined text-[12px]">open_in_new</span>
                        </a>
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/contato">Contato</a>
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/programacao.ics">Baixar Calendário (.ics)</a>
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/estatuto/xml">Estatuto XML</a>
                    </div>
                </div>

                <!-- Meeting Times Column -->
                <div class="md:col-span-3 space-y-2">
                    <span class="text-xs font-bold text-on-surface uppercase tracking-wider block">Encontros Regulares</span>
                    <p class="text-xs text-text-muted">
                        <strong class="text-on-surface block">Quarta-feira: 19:30 às 21:00</strong>
                        Encontro de Ensino &amp; Valores (90 min)
                    </p>
                    <p class="text-xs text-text-muted pt-1">
                        <strong class="text-on-surface block">Domingo: 19:30 às 21:00</strong>
                        Encontro Comunitário &amp; Acolhimento (90 min)
                    </p>
                </div>
            </div>

            <!-- Legal Copyright Row & Domain Ownership Confirmation -->
            <div class="pt-6 border-t border-outline-variant/30 flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left text-xs text-text-muted">
                <div class="space-y-1">
                    <p>
                        &copy; 2026 Igreja Batista Nacional da Paz de Guapó - CNPJ 02.930.019/0001-62. Filiada à <a href="https://cbn.org.br/" target="_blank" rel="noopener noreferrer" class="hover:underline font-medium text-on-surface" title="Convenção Batista Nacional">CBN</a>. Todos os direitos reservados.
                    </p>
                    <p class="text-[11px] text-text-muted/90">
                        O domínio <strong class="text-on-surface font-semibold">ibnpguapo.org.br</strong> e este portal oficial são de propriedade, mantidos e operados oficialmente pela Igreja Batista Nacional da Paz de Guapó, organização religiosa sem fins lucrativos.
                    </p>
                </div>
                <div class="flex items-center gap-4 text-xs shrink-0">
                    <a class="hover:text-primary transition-colors" href="/estatuto">Estatuto Social</a>
                    <span>•</span>
                    <a class="hover:text-primary transition-colors" href="/regimento">Regimento Interno</a>
                    <span>•</span>
                    <a class="hover:text-primary transition-colors inline-flex items-center gap-0.5" href="https://social.ibnpguapo.org.br/" target="_blank" rel="noopener noreferrer">
                        <span>Escola Social</span>
                        <span class="material-symbols-outlined text-[12px]">open_in_new</span>
                    </a>
                    <span>•</span>
                    <a class="hover:text-primary transition-colors" href="/contato">Localização</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive mobile menu script -->
    <script>
        function toggleMobileMenu() {
            const drawer = document.getElementById('mobile-menu-drawer');
            if (drawer) {
                drawer.classList.toggle('hidden');
            }
        }
    </script>
</body>
</html>
