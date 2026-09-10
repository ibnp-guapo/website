<!DOCTYPE html>
<html lang="pt-BR" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IBN da Paz de Guapó - Um Lugar de Paz, Comunhão e Adoração')</title>
    <meta name="description" content="@yield('meta_description', 'Portal oficial da Igreja Batista Nacional da Paz de Guapó-GO. Cultos semanais às quartas e domingos às 19:30. Conheça nossa igreja e venha nos visitar!')">

    <!-- Material Symbols Outlined -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" />

    <!-- Plus Jakarta Sans font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Design System CSS -->
    <link rel="stylesheet" href="/assets/css/app.css">

    @yield('head')
</head>
<body class="bg-surface-cream-light text-on-surface font-sans antialiased min-h-screen flex flex-col selection:bg-secondary-container selection:text-on-secondary-container">

    <!-- TOP APP BAR (Stitch Design Component) -->
    <header class="sticky top-0 z-50 bg-surface-cream-light/95 backdrop-blur-md shadow-sm border-b border-outline-variant/30 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            <!-- Brand Logo & Identity -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform duration-200">
                    <span class="material-symbols-outlined text-[24px]">church</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-base sm:text-lg font-bold text-on-surface tracking-tight leading-tight">IBN da Paz de Guapó</span>
                    <span class="text-[0.6875rem] text-text-muted font-medium tracking-wide">Comunhão • Fé • Edificação</span>
                </div>
            </a>

            <!-- Web Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-6 lg:gap-8 text-sm font-semibold">
                <a href="/" class="pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Início</a>
                <a href="/programacao" class="pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/programacao' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Programação</a>
                <a href="/estatuto" class="pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/estatuto' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Estatuto Social</a>
                <a href="/regimento" class="pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/regimento' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Regimento Interno</a>
                <a href="/sobre" class="pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/sobre' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Sobre Nós</a>
                <a href="/contato" class="pb-1 transition-all duration-200 {{ ($currentRoute ?? '') === '/contato' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface hover:text-primary' }}">Contato</a>
            </nav>

            <!-- Trailing Action: Como Chegar / Horários with location_on -->
            <div class="flex items-center gap-3">
                <a href="/contato" class="hidden sm:inline-flex items-center gap-1.5 bg-primary text-on-primary text-xs font-bold px-4 py-2.5 rounded-xl hover:bg-secondary-container transition-all duration-200 shadow-sm active:scale-95">
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    <span>Como Chegar / Horários</span>
                </a>

                <!-- Mobile Menu Toggle Button -->
                <button type="button" aria-label="Abrir menu de navegação" class="md:hidden p-2 rounded-lg text-on-surface hover:bg-surface-cream-warm transition-colors" onclick="toggleMobileMenu()">
                    <span class="material-symbols-outlined text-[26px]">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Drawer Collapse -->
        <div id="mobile-menu-drawer" class="hidden md:hidden border-t border-outline-variant/30 bg-surface-cream-light px-4 py-4 space-y-2">
            <a href="/" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Início</a>
            <a href="/programacao" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/programacao' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Programação</a>
            <a href="/estatuto" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/estatuto' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Estatuto Social</a>
            <a href="/regimento" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/regimento' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Regimento Interno</a>
            <a href="/sobre" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/sobre' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Sobre Nós</a>
            <a href="/contato" class="block py-2 text-sm font-semibold {{ ($currentRoute ?? '') === '/contato' ? 'text-primary font-bold' : 'text-on-surface hover:text-primary' }}">Contato</a>
            <div class="pt-2 border-t border-outline-variant/30">
                <a href="/contato" class="flex items-center justify-center gap-1.5 w-full bg-primary text-on-primary py-2.5 rounded-xl text-xs font-bold shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    <span>Como Chegar / Horários</span>
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN CANVAS -->
    <main class="flex-grow">
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
                        <div class="w-9 h-9 rounded-xl bg-primary text-on-primary flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">church</span>
                        </div>
                        <span class="text-base font-bold text-on-surface">IBN da Paz de Guapó</span>
                    </div>
                    <p class="text-xs text-text-muted leading-relaxed">
                        Igreja Batista Nacional da Paz de Guapó. Uma comunidade de fé, acolhimento e compromisso com o Evangelho da Graça, filiada à Convenção Batista Nacional (CBN) e à ORMIBAN Goiás.
                    </p>
                    <div class="text-[11px] font-bold text-secondary">
                        CNPJ: 02.930.019/0001-62 • Fundação em 1999 • Guapó-GO
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
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/contato">Contato</a>
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/programacao.ics">Baixar Calendário (.ics)</a>
                        <a class="text-text-muted hover:text-primary transition-colors duration-200" href="/estatuto/xml">Estatuto XML</a>
                    </div>
                </div>

                <!-- Meeting Times Column -->
                <div class="md:col-span-3 space-y-2">
                    <span class="text-xs font-bold text-on-surface uppercase tracking-wider block">Cultos Oficiais</span>
                    <p class="text-xs text-text-muted">
                        <strong class="text-on-surface block">Quarta-feira: 19:30 às 21:00</strong>
                        Culto de Oração & Estudo Bíblico (90 min)
                    </p>
                    <p class="text-xs text-text-muted pt-1">
                        <strong class="text-on-surface block">Domingo: 19:30 às 21:00</strong>
                        Culto de Celebração da Família (90 min)
                    </p>
                </div>
            </div>

            <!-- Legal Copyright Row -->
            <div class="pt-6 border-t border-outline-variant/30 flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left text-xs text-text-muted">
                <p>
                    &copy; 2026 Igreja Batista Nacional da Paz de Guapó - CNPJ 02.930.019/0001-62. Filiada à CBN. Todos os direitos reservados.
                </p>
                <div class="flex items-center gap-4 text-xs">
                    <a class="hover:text-primary transition-colors" href="/estatuto">Estatuto Social</a>
                    <span>•</span>
                    <a class="hover:text-primary transition-colors" href="/regimento">Regimento Interno</a>
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
