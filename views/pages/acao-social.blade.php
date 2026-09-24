@extends('layouts.app')

@section('title', 'Ação Social & Projetos Comunitários | IBNP')
@section('meta_description', 'Conheça os projetos sociais mantidos e apoiados pela IBNP: Escola Infantil em Guapó-GO e Escola Nova Esperança em Angola.')

@section('content')
    <!-- Header Hero Ação Social (Warm Fellowship Design) -->
    <section class="relative overflow-hidden py-12 md:py-20 bg-gradient-to-b from-surface-cream-light via-[#FFFDF9] to-surface-cream-light border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl flex flex-col items-start gap-4">
                <div class="inline-flex items-center gap-2 bg-surface-cream-warm/60 border border-outline-variant/60 px-3.5 py-1.5 rounded-full text-on-surface">
                    <span class="material-symbols-outlined text-secondary text-[18px]">volunteer_activism</span>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary">Responsabilidade &amp; Impacto Social</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-on-surface leading-[1.15] tracking-tight">
                    Ação Social &amp; Educação Infantil
                </h1>
                <p class="text-base sm:text-lg text-text-muted leading-relaxed">
                    Acreditamos que a fé cristã se manifesta concretamente no cuidado ao próximo, na valorização da família e na proteção da infância. Conheça as iniciativas que mantemos localmente em Guapó e que apoiamos internacionalmente.
                </p>
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-surface-cream-warm text-secondary text-xs font-bold">
                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                        <span>Guapó, Goiás • Brasil</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-surface-cream-warm text-secondary text-xs font-bold">
                        <span class="material-symbols-outlined text-[16px]">public</span>
                        <span>Angola • África</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Resumo de Pilares Estruturantes -->
    <section class="py-10 bg-surface-pure border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-2xl bg-surface-cream-light/60 border border-outline-variant/30">
                    <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-[22px]">child_care</span>
                    </div>
                    <span class="text-xs font-bold text-secondary uppercase tracking-wider block">Educação Infantil</span>
                    <p class="text-xs text-text-muted mt-1 leading-relaxed">Cuidado integral, reforço e formação de valores morais para o desenvolvimento de cada criança.</p>
                </div>

                <div class="p-6 rounded-2xl bg-surface-cream-light/60 border border-outline-variant/30">
                    <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-[22px]">home_work</span>
                    </div>
                    <span class="text-xs font-bold text-secondary uppercase tracking-wider block">Mantenedores Locais</span>
                    <p class="text-xs text-text-muted mt-1 leading-relaxed">Governança, infraestrutura e mantenedora oficial da Escola Social em Guapó-GO.</p>
                </div>

                <div class="p-6 rounded-2xl bg-surface-cream-light/60 border border-outline-variant/30">
                    <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-[22px]">language</span>
                    </div>
                    <span class="text-xs font-bold text-secondary uppercase tracking-wider block">Apoio Missionário</span>
                    <p class="text-xs text-text-muted mt-1 leading-relaxed">Compromisso financeiro com ofertas mensais regulares para a Escola Nova Esperança em Angola.</p>
                </div>

                <div class="p-6 rounded-2xl bg-surface-cream-light/60 border border-outline-variant/30">
                    <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-[22px]">fact_check</span>
                    </div>
                    <span class="text-xs font-bold text-secondary uppercase tracking-wider block">Transparência &amp; Ética</span>
                    <p class="text-xs text-text-muted mt-1 leading-relaxed">Prestação de contas aberta e aplicação transparente dos dízimos e ofertas em causas sociais.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção Principal: Projetos Sociais (Guapó e Angola) -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 md:py-20 space-y-12">
        <div class="text-center max-w-3xl mx-auto">
            <span class="text-xs font-bold uppercase tracking-widest text-secondary block mb-2">Frentes de Impacto</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-on-surface">Projetos Mantidos e Apoiados</h2>
            <p class="text-sm text-text-muted mt-2 leading-relaxed">
                Cada iniciativa expressa nosso chamado e compromisso comunitário: atuamos diretamente como mantenedores de uma escola infantil em nossa cidade e cooperamos com ofertas regulares com uma obra educacional no continente africano.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 items-stretch">
            <!-- Projeto 1: Escola Infantil em Guapó (Mantenedores) -->
            <article class="bg-surface-pure rounded-3xl border border-outline-variant/30 p-8 sm:p-10 elevation-warm-1 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/5 rounded-bl-full pointer-events-none"></div>
                <div>
                    <!-- Badge de Papel da IBNP -->
                    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-secondary/15 text-secondary text-xs font-extrabold uppercase tracking-wide">
                            <span class="material-symbols-outlined text-[16px]">verified</span>
                            <span>Mantenedores Oficiais</span>
                        </span>
                        <span class="text-xs font-semibold text-text-muted flex items-center gap-1">
                            <span class="material-symbols-outlined text-[15px] text-primary">location_on</span>
                            <span>Guapó, Goiás • Brasil</span>
                        </span>
                    </div>

                    <h3 class="text-2xl sm:text-3xl font-extrabold text-on-surface mb-3 tracking-tight">
                        Escola Infantil em Guapó
                    </h3>

                    <p class="text-xs sm:text-sm text-secondary font-bold mb-4 uppercase tracking-wider">
                        Iniciativa Educacional &amp; Comunitária Local
                    </p>

                    <p class="text-sm text-text-muted leading-relaxed mb-6 font-normal">
                        A <strong class="text-on-surface">Igreja Batista Nacional da Paz de Guapó (IBNP)</strong> é a entidade fundadora e <strong class="text-on-surface">mantenedora oficial</strong> da Escola Social e Infantil de Guapó. A iniciativa tem por finalidade oferecer suporte socioeducativo para crianças do município, atuando em colaboração direta com as famílias.
                    </p>

                    <!-- Lista de Ações e Escopo -->
                    <div class="space-y-3 mb-8">
                        <div class="flex items-start gap-3 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5">check_circle</span>
                            <span><strong>Educação Infantil &amp; Contraturno:</strong> Atividades de reforço do aprendizado, recreação saudável e formação cidadã.</span>
                        </div>
                        <div class="flex items-start gap-3 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5">check_circle</span>
                            <span><strong>Valores Éticos &amp; Socioemocionais:</strong> Ambiente de acolhimento centrado no amor ao próximo e no respeito mútuo.</span>
                        </div>
                        <div class="flex items-start gap-3 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5">check_circle</span>
                            <span><strong>Suporte Comunitário às Famílias:</strong> Acompanhamento pastoral e apoio direto às mães e aos responsáveis.</span>
                        </div>
                    </div>
                    <!-- Destaque: Coral de Natal Aberto -->
                    <div class="p-4 rounded-2xl bg-surface-cream-warm/50 border border-outline-variant/40 mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div class="space-y-0.5">
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider text-secondary">
                                <span class="material-symbols-outlined text-[14px]">music_note</span>
                                <span>Inscrições Abertas • Dezembro 2026</span>
                            </span>
                            <p class="text-xs font-bold text-on-surface">Coral de Natal Infantil (30 vagas gratuitas)</p>
                            <p class="text-[11px] text-text-muted">Iniciação vocal e canto coral para crianças de 5 a 12 anos em Guapó.</p>
                        </div>
                        <a href="/coral-natal" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-secondary text-on-secondary text-xs font-bold shadow-sm hover:bg-secondary/90 transition-all active:scale-95 whitespace-nowrap shrink-0">
                            <span>Inscrever</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Box Informativo de Status da Página Dedicada -->
                <div class="pt-6 border-t border-outline-variant/30 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2 text-xs text-text-muted">
                        <span class="material-symbols-outlined text-secondary text-[18px]">info</span>
                        <span>A página institucional detalhada do projeto está em elaboração pela mantenedora.</span>
                    </div>
                </div>
            </article>

            <!-- Projeto 2: Escola Nova Esperança (Angola) (Apoiadores) -->
            <article class="bg-surface-pure rounded-3xl border border-outline-variant/30 p-8 sm:p-10 elevation-warm-1 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full pointer-events-none"></div>
                <div>
                    <!-- Badge de Papel da IBNP -->
                    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-primary/15 text-primary text-xs font-extrabold uppercase tracking-wide">
                            <span class="material-symbols-outlined text-[16px]">public</span>
                            <span>Apoiadores Regulares</span>
                        </span>
                        <span class="text-xs font-semibold text-text-muted flex items-center gap-1">
                            <span class="material-symbols-outlined text-[15px] text-secondary">flight_takeoff</span>
                            <span>Angola • África</span>
                        </span>
                    </div>

                    <h3 class="text-2xl sm:text-3xl font-extrabold text-on-surface mb-3 tracking-tight">
                        Escola Nova Esperança
                    </h3>

                    <p class="text-xs sm:text-sm text-primary font-bold mb-4 uppercase tracking-wider">
                        Missão Social &amp; Educacional Transcultural
                    </p>

                    <p class="text-sm text-text-muted leading-relaxed mb-6 font-normal">
                        A IBNP atua com fidelidade como parceira e <strong class="text-on-surface">apoiadora contínua</strong> da <strong class="text-on-surface">Escola Infantil Nova Esperança</strong> em Angola. Por meio da generosidade de nossa comunidade, destinamos <strong class="text-on-surface">ofertas mensais regulares</strong> dedicadas a subsidiar as atividades pedagógicas, alimentação e o amparo social das crianças angolanas.
                    </p>

                    <!-- Lista de Ações e Escopo -->
                    <div class="space-y-3 mb-8">
                        <div class="flex items-start gap-3 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span>
                            <span><strong>Ofertas Mensais Regulares:</strong> Apoio financeiro contínuo e programado enviado pela IBNP para custeio operacional.</span>
                        </div>
                        <div class="flex items-start gap-3 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span>
                            <span><strong>Alfabetização e Acesso à Educação:</strong> Oportunidade de aprendizagem e dignidade para crianças em situação de vulnerabilidade.</span>
                        </div>
                        <div class="flex items-start gap-3 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span>
                            <span><strong>Cooperação Missionária:</strong> Sustento do projeto no campo e oração contínua de toda a igreja em Guapó.</span>
                        </div>
                    </div>
                </div>

                <!-- Box Informativo de Status da Página Dedicada -->
                <div class="pt-6 border-t border-outline-variant/30 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2 text-xs text-text-muted">
                        <span class="material-symbols-outlined text-primary text-[18px]">info</span>
                        <span>A página institucional detalhada do projeto está em fase de elaboração pela equipe missionária.</span>
                    </div>
                </div>
            </article>
        </div>

        <!-- Seção: Como Apoiar e Participar -->
        <section class="bg-surface-cream-warm/40 border border-outline-variant/40 rounded-3xl p-8 sm:p-12 elevation-warm-1">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-secondary block">Participe das Nossas Obras</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">
                        Como Você Pode Apoiar a Ação Social da IBNP
                    </h3>
                    <p class="text-sm text-text-muted leading-relaxed">
                        Nossas iniciativas sociais sobrevivem e avançam graças às orações, ao trabalho voluntário dedicado e às contribuições espontâneas dos membros e amigos da igreja. Se você deseja contribuir com mantimentos para a Escola em Guapó ou com ofertas missionárias destinadas a Angola, participe conosco!
                    </p>
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20saber%20como%20posso%20apoiar%20os%20projetos%20sociais%20da%20IBNP." target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-[#25D366] text-white text-xs font-bold shadow-sm hover:opacity-95 transition-all active:scale-95">
                            <span class="material-symbols-outlined text-[18px]">chat</span>
                            <span>Conversar sobre Ação Social no WhatsApp</span>
                        </a>
                        <a href="/programacao" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-primary text-on-primary text-xs font-bold shadow-sm hover:bg-secondary-container transition-all active:scale-95">
                            <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                            <span>Participar dos Encontros</span>
                        </a>
                    </div>
                </div>

                <!-- Box PIX Transparência -->
                <div class="lg:col-span-5 bg-surface-pure rounded-2xl p-6 sm:p-8 border border-outline-variant/30 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[22px]">payments</span>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-secondary uppercase tracking-wider block">Contribuições via PIX</span>
                            <span class="text-sm font-extrabold text-on-surface">Ação Social &amp; Missões</span>
                        </div>
                    </div>
                    <p class="text-xs text-text-muted leading-relaxed">
                        Contribua diretamente com a manutenção das obras sociais. A chave PIX oficial da igreja é o nosso CNPJ:
                    </p>
                    <div class="bg-surface-cream-light p-3.5 rounded-xl border border-outline-variant/30 flex items-center justify-between gap-2">
                        <span class="font-mono text-xs sm:text-sm font-bold text-on-surface select-all">02.930.019/0001-62</span>
                        <span class="text-[11px] font-semibold text-secondary bg-surface-pure px-2.5 py-1 rounded-md border border-outline-variant/30">CNPJ IBNP</span>
                    </div>
                    <p class="text-[11px] text-text-muted">
                        Banco: <strong>Igreja Batista Nacional da Paz de Guapó</strong>. Destinação ética e transparente para sustento dos projetos sociais e educacionais.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
