<!DOCTYPE html>
<html lang="pt-BR" class="h-full scroll-smooth bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IBN da Paz de Guapó - Um Lugar de Recomeço, Fé e Comunhão')</title>
    <meta name="description" content="@yield('meta_description', 'Website oficial da Igreja Batista Nacional da Paz de Guapó-GO. Cultos semanais às quartas e domingos às 19:30. Conheça nossa igreja e venha nos visitar!')">
    
    <!-- Design System CSS -->
    <link rel="stylesheet" href="/assets/css/app.css">

    <!-- Google Fonts: Inter & Merriweather -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Merriweather:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
    
    @yield('head')
</head>
<body class="h-full flex flex-col text-slate-800 antialiased font-sans bg-slate-50 selection:bg-orange-100 selection:text-ibnp-primary">

    <!-- Header Principal -->
    <header class="bg-white/95 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50 shadow-xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo Institucional -->
            <a href="/" class="flex items-center gap-3.5 group">
                <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-ibnp-primary to-ibnp-secondary flex items-center justify-center text-white font-black text-xl shadow-sm group-hover:scale-105 transition-transform">
                    P
                </span>
                <div>
                    <span class="block font-black text-lg sm:text-xl text-slate-900 tracking-tight leading-none">
                        IBN da Paz <span class="text-ibnp-primary font-bold">Guapó</span>
                    </span>
                    <span class="block text-[11px] font-semibold text-slate-400 uppercase tracking-wider mt-0.5">
                        Igreja Batista Nacional
                    </span>
                </div>
            </a>

            <!-- Navegação Desktop -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="/" class="hover:text-ibnp-primary transition-colors {{ ($currentRoute ?? '') === '/' ? 'text-ibnp-primary font-bold' : '' }}">Início</a>
                <a href="/programacao" class="hover:text-ibnp-primary transition-colors {{ ($currentRoute ?? '') === '/programacao' ? 'text-ibnp-primary font-bold' : '' }}">Programação</a>
                <a href="/estatuto" class="hover:text-ibnp-primary transition-colors {{ ($currentRoute ?? '') === '/estatuto' ? 'text-ibnp-primary font-bold' : '' }}">Estatuto</a>
                <a href="/regimento" class="hover:text-ibnp-primary transition-colors {{ ($currentRoute ?? '') === '/regimento' ? 'text-ibnp-primary font-bold' : '' }}">Regimento</a>
                <a href="/sobre" class="hover:text-ibnp-primary transition-colors {{ ($currentRoute ?? '') === '/sobre' ? 'text-ibnp-primary font-bold' : '' }}">Sobre Nós</a>
                <a href="/contato" class="hover:text-ibnp-primary transition-colors {{ ($currentRoute ?? '') === '/contato' ? 'text-ibnp-primary font-bold' : '' }}">Contato</a>
            </nav>

            <!-- Ações Rápidas -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20informa%C3%A7%C3%B5es%20sobre%20a%20IBN%20da%20Paz%20de%20Guap%C3%B3." target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-ibnp-primary text-white text-xs font-bold hover:bg-orange-700 transition shadow-sm">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.062-2.121-.527-1.785-.736-2.92-2.548-3.008-2.667-.087-.12-.718-.956-.718-1.82 0-.864.453-1.289.615-1.465.161-.176.353-.22.47-.22.12 0 .24.002.344.007.112.006.262-.042.41.314.152.368.522 1.272.568 1.365.046.093.077.202.015.324-.061.123-.092.2-.183.307-.091.107-.192.24-.274.322-.093.093-.19.195-.082.381.108.186.48 1.03 1.03 1.52.709.633 1.307.829 1.493.921.186.093.295.078.404-.047.11-.125.47-.547.596-.734.125-.187.251-.156.422-.093.171.062 1.085.512 1.272.605.187.094.312.14.358.219.046.078.046.452-.098.857z"/></svg>
                    <span>Fale no WhatsApp</span>
                </a>
            </div>

            <!-- Botão Mobile Menu -->
            <button type="button" onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100" aria-label="Abrir menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>

        <!-- Menu Mobile Drawer -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-100 bg-white px-4 pt-3 pb-6 space-y-3">
            <a href="/" class="block px-3 py-2 rounded-lg text-sm font-semibold {{ ($currentRoute ?? '') === '/' ? 'text-ibnp-primary bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Início</a>
            <a href="/programacao" class="block px-3 py-2 rounded-lg text-sm font-semibold {{ ($currentRoute ?? '') === '/programacao' ? 'text-ibnp-primary bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Programação</a>
            <a href="/estatuto" class="block px-3 py-2 rounded-lg text-sm font-semibold {{ ($currentRoute ?? '') === '/estatuto' ? 'text-ibnp-primary bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Estatuto Social</a>
            <a href="/regimento" class="block px-3 py-2 rounded-lg text-sm font-semibold {{ ($currentRoute ?? '') === '/regimento' ? 'text-ibnp-primary bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Regimento Interno</a>
            <a href="/sobre" class="block px-3 py-2 rounded-lg text-sm font-semibold {{ ($currentRoute ?? '') === '/sobre' ? 'text-ibnp-primary bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Sobre Nós</a>
            <a href="/contato" class="block px-3 py-2 rounded-lg text-sm font-semibold {{ ($currentRoute ?? '') === '/contato' ? 'text-ibnp-primary bg-orange-50' : 'text-slate-700 hover:bg-slate-50' }}">Contato & Localização</a>
            <div class="pt-2 border-t border-slate-100">
                <a href="https://wa.me/556298700089" target="_blank" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl bg-ibnp-primary text-white text-xs font-bold">
                    Fale no WhatsApp (62) 9870-0089
                </a>
            </div>
        </div>
    </header>

    <!-- Conteúdo Específico da View -->
    @yield('content')

    <!-- Rodapé Unificado -->
    <footer class="bg-slate-900 text-slate-400 text-xs border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- Coluna 1: Identidade -->
                <div class="md:col-span-1">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-8 h-8 rounded-lg bg-ibnp-primary flex items-center justify-center text-white font-black text-base">P</span>
                        <span class="font-extrabold text-base text-white tracking-tight">IBN da Paz <span class="text-ibnp-primary">Guapó</span></span>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed mb-4">
                        Um lugar de recomeço, oração e comunhão familiar em Guapó-GO. Fundada em 14 de janeiro de 1999.
                    </p>
                    <span class="inline-block text-[11px] font-semibold text-slate-400 bg-slate-800/80 px-2.5 py-1 rounded-md">
                        CNPJ: 02.930.019/0001-62
                    </span>
                </div>

                <!-- Coluna 2: Navegação -->
                <div>
                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-200 mb-4">Navegação</h4>
                    <ul class="space-y-2.5">
                        <li><a href="/" class="hover:text-white transition-colors">Página Inicial</a></li>
                        <li><a href="/programacao" class="hover:text-white transition-colors">Programação de Cultos</a></li>
                        <li><a href="/sobre" class="hover:text-white transition-colors">História & Liderança</a></li>
                        <li><a href="/contato" class="hover:text-white transition-colors">Localização & Contato</a></li>
                    </ul>
                </div>

                <!-- Coluna 3: Governança Aberta -->
                <div>
                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-200 mb-4">Governança Digital</h4>
                    <ul class="space-y-2.5">
                        <li><a href="/estatuto" class="hover:text-white transition-colors">Estatuto Social (Akoma Ntoso)</a></li>
                        <li><a href="/regimento" class="hover:text-white transition-colors">Regimento Interno</a></li>
                        <li><a href="/estatuto/xml" class="hover:text-white transition-colors">Download XML Averbado</a></li>
                        <li><a href="/programacao/ical" class="hover:text-white transition-colors">Calendário Litúrgico (.ics)</a></li>
                    </ul>
                </div>

                <!-- Coluna 4: Encontros e Endereço -->
                <div>
                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-200 mb-4">Cultos Regulares</h4>
                    <p class="text-slate-300 font-semibold mb-1">Quarta-feira às 19:30</p>
                    <p class="text-slate-400 text-[11px] mb-3">Oração e Estudo Bíblico (90 min)</p>
                    <p class="text-slate-300 font-semibold mb-1">Domingo às 19:30</p>
                    <p class="text-slate-400 text-[11px] mb-4">Celebração da Família (90 min)</p>
                    <p class="text-[11px] text-slate-400">
                        📍 Rua Presidente Kennedy, Qd. 21, Lt. 13 – Centro, Guapó – GO
                    </p>
                </div>
            </div>

            <div class="border-t border-slate-800/80 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-[11px]">
                <p>Filiada à <strong>Convenção Batista Nacional (CBN)</strong> e à <strong>ORMIBAN Goiás</strong>.</p>
                <p>&copy; 2026 Igreja Batista Nacional da Paz de Guapó. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
