@extends('layouts.app')

@section('title', 'IBN da Paz de Guapó - Um Lugar de Paz, Comunhão e Adoração')
@section('meta_description', 'Portal oficial da Igreja Batista Nacional da Paz de Guapó-GO. Cultos presenciais às quartas e domingos às 19:30. Venha fazer parte da nossa família!')

@section('content')
<!-- HERO SECTION (Stitch Mockup Exact Layout) -->
<section class="relative overflow-hidden py-12 md:py-20 lg:py-24 bg-gradient-to-b from-surface-cream-light via-[#FFFDF9] to-surface-cream-light" id="inicio">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            <!-- Text Content -->
            <div class="lg:col-span-7 flex flex-col items-start gap-4">
                <!-- City & Affiliation Pill -->
                <a href="https://cbn.org.br/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-surface-cream-warm/40 hover:bg-surface-cream-warm border border-outline-variant/60 px-3.5 py-1.5 rounded-full text-on-surface transition-all group" title="Filiada à Convenção Batista Nacional (abre em nova aba)">
                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary">Guapó – Goiás • Filiada à CBN</span>
                    <span class="material-symbols-outlined text-[14px] text-secondary group-hover:translate-x-0.5 transition-transform">open_in_new</span>
                </a>

                <!-- Main Headline -->
                <h1 class="text-3xl sm:text-5xl lg:text-[3.25rem] font-extrabold text-on-surface leading-[1.15] tracking-tight">
                    Um lugar de paz, comunhão e adoração a Deus em Guapó
                </h1>

                <!-- Subtitle -->
                <p class="text-base sm:text-lg text-text-muted max-w-2xl leading-relaxed">
                    Seja muito bem-vindo à nossa congregação. Conheça nossos cultos semanais e faça parte da nossa família de fé. Venha viver momentos transformadores na presença do Senhor.
                </p>

                <!-- Action Buttons (Ad Grants High-Visibility CTAs) -->
                <div class="flex flex-wrap items-center gap-3 pt-2 w-full sm:w-auto">
                    <!-- Primary CTA: Planeje sua Visita -->
                    <a class="inline-flex items-center justify-center gap-2 bg-primary text-on-primary text-sm font-bold px-6 py-3.5 rounded-xl shadow-md hover:bg-secondary-container transition-all duration-200 active:scale-95" href="#programacao">
                        <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                        <span>Planeje sua Visita</span>
                    </a>
                    <!-- WhatsApp Pastoral CTA -->
                    <a class="inline-flex items-center justify-center gap-2 bg-[#25D366] text-white text-sm font-bold px-5 py-3.5 rounded-xl shadow-sm hover:bg-[#1ebd59] transition-all duration-200 active:scale-95" href="https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20informa%C3%A7%C3%B5es%20e%20atendimento%20pastoral%20na%20IBN%20da%20Paz%20de%20Guap%C3%B3." target="_blank" rel="noopener noreferrer">
                        <span class="material-symbols-outlined text-[20px]">chat</span>
                        <span>Atendimento Pastoral</span>
                    </a>
                    <!-- Como Chegar CTA -->
                    <a class="inline-flex items-center justify-center gap-2 bg-surface-pure border border-secondary text-secondary text-sm font-bold px-5 py-3.5 rounded-xl hover:bg-secondary-container/10 transition-all duration-200 active:scale-95" href="#localizacao">
                        <span class="material-symbols-outlined text-[20px]">directions</span>
                        <span>Como Chegar</span>
                    </a>
                </div>

                <!-- Verse highlight strip -->
                <div class="mt-4 p-4 rounded-xl bg-surface-cream-warm/30 border-l-4 border-primary text-on-surface w-full">
                    <p class="text-sm italic text-on-surface">
                        “Quão amáveis são os teus tabernáculos, SENHOR dos Exércitos! A minha alma está desejosa, e desfalece pelos átrios do SENHOR.”
                    </p>
                    <span class="text-xs font-bold text-secondary mt-1 block">Salmos 84:1-2</span>
                </div>
            </div>

            <!-- Hero Visual Feature Card (Optimized LCP Element) -->
            <div class="lg:col-span-5">
                <div class="relative rounded-2xl p-3 bg-surface-pure border border-outline-variant/30 elevation-warm-2">
                    <div class="relative overflow-hidden rounded-xl h-80 sm:h-96 w-full">
                        <img 
                            class="w-full h-full object-cover object-center transform hover:scale-105 transition-transform duration-700 ease-out" 
                            alt="Educadora contando histórias e ensinando crianças com livros em ambiente acolhedor, simbolizando a transformação de vidas pela educação infantil" 
                            src="/assets/images/hero-transformacao-infantil.jpg"
                            width="640"
                            height="427"
                            loading="eager"
                            fetchpriority="high"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-on-surface/85 via-on-surface/25 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-surface-pure">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-live-badge text-on-primary text-xs font-bold mb-2 shadow-sm">
                                <span class="material-symbols-outlined text-[14px]">volunteer_activism</span>
                                <span>Transformação de Vidas</span>
                            </div>
                            <h2 class="text-xl font-bold text-surface-pure drop-shadow-sm">Educação, fé e acolhimento para a infância</h2>
                            <p class="text-xs text-surface-pure/90 line-clamp-2 mt-0.5">Construindo um futuro digno e alicerçado em valores cristãos para as crianças e famílias de Guapó.</p>
                        </div>
                    </div>

                    <!-- Floating Quick Stat Badges -->
                    <div class="grid grid-cols-2 gap-3 mt-3 pt-1">
                        <div class="flex items-center gap-3 p-3 bg-surface-cream-light rounded-xl border border-outline-variant/20">
                            <span class="material-symbols-outlined text-primary text-[28px]">schedule</span>
                            <div>
                                <span class="text-[11px] font-bold text-text-muted block">Domingo &amp; Quarta</span>
                                <strong class="text-base font-bold text-on-surface">19h30</strong>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-surface-cream-light rounded-xl border border-outline-variant/20">
                            <span class="material-symbols-outlined text-secondary text-[28px]">verified</span>
                            <div>
                                <span class="text-[11px] font-bold text-text-muted block">Desde 1999</span>
                                <strong class="text-base font-bold text-on-surface">Fiel à Palavra</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICE TIME BAR (Horizontal Announcement Banner) -->
<div class="bg-surface-cream-warm/40 border-y border-outline-variant/40 py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-between gap-4 text-on-surface">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-[22px]">notifications_active</span>
            <span class="text-xs sm:text-sm font-semibold text-on-surface">Avisos da Semana: Inscrições abertas para novos membros e discipulado bíblico.</span>
        </div>
        <div class="flex items-center gap-6 text-xs font-bold text-secondary">
            <a href="#escola-social" class="flex items-center gap-1.5 hover:underline transition-all">
                <span class="material-symbols-outlined text-[16px]">volunteer_activism</span>
                <span>Escola Social de Guapó</span>
            </a>
        </div>
    </div>
</div>

<!-- WEEKLY SERVICES WIDGET ("Cultos da Semana") -->
<section class="py-16 md:py-24 bg-surface-pure" id="programacao">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-surface-cream-warm/50 border border-outline-variant/50 text-secondary text-xs font-bold mb-3">
                <span class="material-symbols-outlined text-[16px]">event</span>
                <span>Programação Oficial</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-on-surface">
                Cultos da Semana
            </h2>
            <p class="text-sm sm:text-base text-text-muted mt-2">
                Momentos regulares de comunhão, oração fervorosa e ensinamento fiel das Sagradas Escrituras. Esperamos por você e sua casa.
            </p>
        </div>

        <!-- 2 Side-by-Side Focused Service Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card 1: Quarta-feira -->
            <div class="relative bg-surface-pure rounded-2xl p-6 md:p-8 border border-outline-variant/30 elevation-warm-1 flex flex-col justify-between hover:border-secondary transition-all duration-300">
                <div>
                    <!-- Header Row -->
                    <div class="flex items-center justify-between gap-2 mb-4">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-surface-cream-light border border-outline-variant text-on-surface text-xs font-bold">
                            <span class="material-symbols-outlined text-secondary text-[18px]">alarm</span>
                            <span>Quarta-feira às 19:30</span>
                        </div>
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-surface-cream-warm/40 text-secondary text-xs font-bold border border-outline-variant/40">
                            <span class="material-symbols-outlined text-[14px]">menu_book</span>
                            Estudo Bíblico • 90 min
                        </span>
                    </div>

                    <!-- Content -->
                    <h3 class="text-xl sm:text-2xl font-bold text-on-surface mb-2">
                        Culto de Ensino
                    </h3>
                    <p class="text-sm text-text-muted mb-6 leading-relaxed">
                        Estudo bíblico expositivo e sistemático das Sagradas Escrituras. Um momento dedicado ao aprofundamento doutrinário, maturidade na fé cristã e edificação espiritual para toda a igreja.
                    </p>

                    <!-- Points highlight -->
                    <div class="space-y-2 border-t border-outline-variant/20 pt-4 mb-6">
                        <div class="flex items-center gap-2 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-secondary text-[18px]">check_circle</span>
                            <span>Estudo sistemático e doutrinário para toda a família</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-secondary text-[18px]">check_circle</span>
                            <span>Exposição temática e pastoral dos livros bíblicos</span>
                        </div>
                    </div>
                </div>

                <!-- Action -->
                <div class="pt-2 flex items-center justify-between border-t border-outline-variant/20">
                    <a class="inline-flex items-center gap-2 text-secondary font-bold text-xs hover:gap-3 transition-all" href="/programacao">
                        <span>Ver grade completa</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                    <a class="text-xs text-text-muted hover:text-primary transition" href="/programacao.ics" title="Adicionar ao calendário">
                        + iCal
                    </a>
                </div>
            </div>

            <!-- Card 2: Domingo -->
            <div class="relative bg-surface-pure rounded-2xl p-6 md:p-8 border border-outline-variant/30 elevation-warm-1 flex flex-col justify-between hover:border-primary transition-all duration-300">
                <div>
                    <!-- Header Row -->
                    <div class="flex items-center justify-between gap-2 mb-4">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-surface-cream-light border border-outline-variant text-on-surface text-xs font-bold">
                            <span class="material-symbols-outlined text-primary text-[18px]">alarm</span>
                            <span>Domingo às 19:30</span>
                        </div>
                        <!-- Presential Badge -->
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary text-on-primary text-xs font-bold shadow-sm">
                            <span class="material-symbols-outlined text-[14px]">diversity_1</span>
                            <span>Presencial • 90 min</span>
                        </div>
                    </div>

                    <!-- Content -->
                    <h3 class="text-xl sm:text-2xl font-bold text-on-surface mb-2">
                        Culto de Celebração
                    </h3>
                    <p class="text-sm text-text-muted mb-6 leading-relaxed">
                        Culto congregacional com louvor, adoração, comunhão fraterna e ministração da Palavra de Deus. Celebramos a graça salvadora de Cristo Jesus com recepção acolhedora para novos visitantes.
                    </p>

                    <!-- Points highlight -->
                    <div class="space-y-2 border-t border-outline-variant/20 pt-4 mb-6">
                        <div class="flex items-center gap-2 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
                            <span>Louvor congregacional vibrante e comunhão fraterna</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
                            <span>Ministração da Palavra de Deus para edificação espiritual</span>
                        </div>
                    </div>
                </div>

                <!-- Action -->
                <div class="pt-2 flex items-center justify-between border-t border-outline-variant/20">
                    <a class="inline-flex items-center gap-2 text-primary font-bold text-xs hover:gap-3 transition-all" href="/programacao">
                        <span>Ver detalhes da programação</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                    <a class="text-xs text-text-muted hover:text-primary transition" href="/programacao.ics" title="Adicionar ao calendário">
                        + iCal
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MINISTRIES & CHURCH COMMUNITY SECTION ("Ministérios da Igreja") -->
<section class="py-16 md:py-24 bg-surface-pure border-t border-outline-variant/30" id="ministerios">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-surface-cream-warm/50 border border-outline-variant/50 text-secondary text-xs font-bold mb-3">
                <span class="material-symbols-outlined text-[16px]">groups</span>
                <span>Vida em Comunidade &amp; Edificação</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-on-surface">
                Ministérios da Igreja
            </h2>
            <p class="text-sm sm:text-base text-text-muted mt-2 leading-relaxed">
                Nossos ministérios atuam para acolher, ensinar, servir e discipular pessoas em todas as fases da vida, fortalecendo a fé e a comunhão em Guapó-GO.
            </p>
        </div>

        <!-- 4 Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Card 1: Paz Kids -->
            <div class="p-6 rounded-2xl bg-surface-cream-light border border-outline-variant/30 elevation-warm-1 flex flex-col justify-between hover:border-secondary transition-all duration-300">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-surface-cream-warm/60 text-secondary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[28px]">child_care</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary block mb-1">Crianças de 0 a 11 anos</span>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Paz Kids (Ministério Infantil)</h3>
                    <p class="text-xs text-text-muted leading-relaxed mb-4">
                        Acolhimento amoroso e aprendizado bíblico dedicado durante os cultos de domingo, com lições lúdicas, professores capacitados e ambiente seguro.
                    </p>
                </div>
                <div class="pt-3 border-t border-outline-variant/20 flex items-center gap-2 text-xs font-semibold text-on-surface">
                    <span class="material-symbols-outlined text-secondary text-[16px]">check_circle</span>
                    <span>Espaço dedicado durante os cultos</span>
                </div>
            </div>

            <!-- Card 2: Louvor & Adoração -->
            <div class="p-6 rounded-2xl bg-surface-cream-light border border-outline-variant/30 elevation-warm-1 flex flex-col justify-between hover:border-primary transition-all duration-300">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-surface-cream-warm/60 text-primary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[28px]">music_note</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-primary block mb-1">Música &amp; Celebração</span>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Louvor e Adoração</h3>
                    <p class="text-xs text-text-muted leading-relaxed mb-4">
                        Ministração musical congregacional com hinos bíblicos e cânticos de adoração a Deus, conduzindo os corações em reverência e gratidão a Jesus.
                    </p>
                </div>
                <div class="pt-3 border-t border-outline-variant/20 flex items-center gap-2 text-xs font-semibold text-on-surface">
                    <span class="material-symbols-outlined text-primary text-[16px]">check_circle</span>
                    <span>Cultos regulares às quartas e domingos</span>
                </div>
            </div>

            <!-- Card 3: Discipulado & Famílias -->
            <div class="p-6 rounded-2xl bg-surface-cream-light border border-outline-variant/30 elevation-warm-1 flex flex-col justify-between hover:border-secondary transition-all duration-300">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-surface-cream-warm/60 text-secondary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[28px]">diversity_1</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary block mb-1">Maturidade Cristã</span>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Discipulado e Famílias</h3>
                    <p class="text-xs text-text-muted leading-relaxed mb-4">
                        Estudos bíblicos sistemáticos, integração fraterna e apoio pastoral para fortalecer os lares e conduzir cada cristão à maturidade da fé.
                    </p>
                </div>
                <div class="pt-3 border-t border-outline-variant/20 flex items-center gap-2 text-xs font-semibold text-on-surface">
                    <span class="material-symbols-outlined text-secondary text-[16px]">check_circle</span>
                    <span>Estudos e aconselhamento pastoral</span>
                </div>
            </div>

            <!-- Card 4: Ação Social Comunitária -->
            <div class="p-6 rounded-2xl bg-surface-cream-light border border-outline-variant/30 elevation-warm-1 flex flex-col justify-between hover:border-primary transition-all duration-300">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-surface-cream-warm/60 text-primary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[28px]">volunteer_activism</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-primary block mb-1">Amor em Ação</span>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Ação Social Comunitária</h3>
                    <p class="text-xs text-text-muted leading-relaxed mb-4">
                        Solidariedade contínua com arrecadação de alimentos, apoio a lares em vulnerabilidade e iniciativas sociais em parceria com a comunidade.
                    </p>
                </div>
                <div class="pt-3 border-t border-outline-variant/20 flex items-center gap-2 text-xs font-semibold text-on-surface">
                    <span class="material-symbols-outlined text-primary text-[16px]">check_circle</span>
                    <span>Apoio solidário contínuo em Guapó</span>
                </div>
            </div>
        </div>

        <!-- Interactive Pastoral Callout & Prayer Request Banner -->
        <div class="p-6 sm:p-8 rounded-3xl bg-surface-cream-warm/30 border border-outline-variant/40 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-secondary text-on-secondary flex items-center justify-center shrink-0 shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">support_agent</span>
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-bold text-on-surface">
                        Precisa de oração, aconselhamento ou deseja participar?
                    </h3>
                    <p class="text-xs sm:text-sm text-text-muted mt-0.5">
                        Nossa equipe pastoral está à disposição para orar pela sua vida, tirar dúvidas e acolher sua família.
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a href="https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20enviar%20um%20pedido%20de%20ora%C3%A7%C3%A3o%20para%20a%20IBN%20da%20Paz." target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-primary text-on-primary text-xs sm:text-sm font-bold shadow-sm hover:bg-secondary-container transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[18px]">favorite</span>
                    <span>Enviar Pedido de Oração</span>
                </a>
                <a href="#programacao" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-surface-pure border border-secondary text-secondary text-xs sm:text-sm font-bold hover:bg-secondary-container/10 transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                    <span>Planeje sua Visita</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- COMMUNITY & SOCIAL INITIATIVE SECTION ("Escola Social de Guapó") -->
<section class="py-16 md:py-24 bg-surface-cream-warm/25 border-y border-outline-variant/30" id="escola-social">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-surface-cream-light border border-outline-variant/50 text-secondary text-xs font-bold mb-3">
                <span class="material-symbols-outlined text-[16px]">volunteer_activism</span>
                <span>Iniciativa de Impacto Social Comunitário</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-on-surface">
                Escola Social de Guapó
            </h2>
            <p class="text-sm sm:text-base text-text-muted mt-2 leading-relaxed">
                A IBN da Paz de Guapó é a entidade mantenedora legal da Escola Social de Guapó, iniciativa de acolhimento e suporte continuado para atender as famílias e a infância em Guapó com atividades socioeducativas, contraturno escolar e centro de convivência comunitária.
            </p>
        </div>

        <!-- 3 Pillars Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Pillar 1: Educação Infantil -->
            <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1 flex flex-col justify-between hover:border-secondary transition-all duration-300">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-surface-cream-warm/50 text-secondary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[28px]">child_care</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary block mb-1">Primeira Infância</span>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Educação Infantil</h3>
                    <p class="text-sm text-text-muted leading-relaxed mb-4">
                        Ambiente acolhedor, seguro e lúdico para o desenvolvimento cognitivo e emocional das crianças, fundamentado em valores de amor ao próximo e cidadania.
                    </p>
                </div>
                <div class="pt-3 border-t border-outline-variant/20 flex items-center gap-2 text-xs font-semibold text-on-surface">
                    <span class="material-symbols-outlined text-secondary text-[16px]">check_circle</span>
                    <span>Atendimento e formação integral para a infância</span>
                </div>
            </div>

            <!-- Pillar 2: Contraturno Escolar -->
            <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1 flex flex-col justify-between hover:border-primary transition-all duration-300">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-surface-cream-warm/50 text-primary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[28px]">school</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-primary block mb-1">Apoio Pedagógico e Oficinas</span>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Contraturno Escolar</h3>
                    <p class="text-sm text-text-muted leading-relaxed mb-4">
                        Oficinas formativas, reforço de aprendizagem, alfabetização, arte e incentivo à leitura, oferecendo alternativas enriquecedoras no período complementar.
                    </p>
                </div>
                <div class="pt-3 border-t border-outline-variant/20 flex items-center gap-2 text-xs font-semibold text-on-surface">
                    <span class="material-symbols-outlined text-primary text-[16px]">check_circle</span>
                    <span>Oficinas e suporte pedagógico no contraturno</span>
                </div>
            </div>

            <!-- Pillar 3: Centro Comunitário & Auditório -->
            <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1 flex flex-col justify-between hover:border-secondary transition-all duration-300">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-surface-cream-warm/50 text-secondary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[28px]">diversity_3</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary block mb-1">Integração Comunitária</span>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Centro Comunitário &amp; Auditório</h3>
                    <p class="text-sm text-text-muted leading-relaxed mb-4">
                        Espaço estruturado para encontros familiares, palestras socioeducativas, capacitação de pais e integração comunitária para o bem-estar de Guapó.
                    </p>
                </div>
                <div class="pt-3 border-t border-outline-variant/20 flex items-center gap-2 text-xs font-semibold text-on-surface">
                    <span class="material-symbols-outlined text-secondary text-[16px]">check_circle</span>
                    <span>Espaço de convivência familiar e cidadania</span>
                </div>
            </div>
        </div>

        <!-- Callout Banner with External Link -->
        <div class="bg-surface-pure rounded-3xl p-6 sm:p-8 md:p-10 border border-outline-variant/40 elevation-warm-1 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-primary text-on-primary flex items-center justify-center shrink-0 shadow-sm">
                    <span class="material-symbols-outlined text-[32px]">handshake</span>
                </div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-surface-cream-light text-secondary text-[11px] font-bold mb-1">
                        <span class="material-symbols-outlined text-[14px]">verified</span>
                        <span>Iniciativa Comunitária • Mantenedora: IBN da Paz (CNPJ 02.930.019/0001-62)</span>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-on-surface">
                        Conheça o projeto e participe das ações sociais da nossa comunidade
                    </h3>
                    <p class="text-xs sm:text-sm text-text-muted mt-1 leading-relaxed">
                        Acesse a plataforma oficial da Escola Social de Guapó para conferir o programa socioeducativo, parcerias e formas de apoiar esta causa.
                    </p>
                </div>
            </div>
            <a href="https://social.ibnpguapo.org.br/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 bg-primary text-on-primary text-sm font-bold px-7 py-3.5 rounded-xl shadow-md hover:bg-secondary-container transition-all duration-200 active:scale-95 whitespace-nowrap shrink-0" title="Conhecer o projeto da Escola Social de Guapó (abre em nova aba)">
                <span>Conhecer a Escola Social</span>
                <span class="material-symbols-outlined text-[18px]">open_in_new</span>
            </a>
        </div>
    </div>
</section>

<!-- GOVERNANCE & CIVIC TRANSPARENCY SECTION ("Transparência e Estatuto Social") -->
<section class="py-16 md:py-24 bg-surface-cream-light border-y border-outline-variant/30" id="estatuto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-surface-pure rounded-3xl p-6 sm:p-10 md:p-12 border border-outline-variant/40 elevation-warm-1">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left Info Block -->
                <div class="lg:col-span-7 space-y-4">
                    <!-- Transparency Tags -->
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-high text-on-surface text-xs font-bold">
                            <span class="material-symbols-outlined text-[16px]">account_balance</span>
                            Transparência e Governança Institucional
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-cream-warm/60 border border-outline-variant/50 text-secondary text-xs font-bold">
                            <span class="material-symbols-outlined text-[14px]">verified</span>
                            Documentos Oficiais Registrados
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-cream-light border border-outline text-on-surface-variant text-xs font-medium">
                            <span class="material-symbols-outlined text-[14px]">public</span>
                            Acesso Aberto e Livre
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-4xl font-bold text-on-surface leading-tight">
                        Conformidade, Clareza e Fé Responsável
                    </h2>

                    <p class="text-sm sm:text-base text-text-muted leading-relaxed">
                        Em respeito a Deus, à congregação e à comunidade de Guapó-GO, a Igreja Batista Nacional da Paz disponibiliza seus documentos normativos e atos constitutivos para consulta pública. Nossos estatutos regem com integridade as diretrizes doutrinárias, patrimoniais e assembleares, alinhados à <a href="https://cbn.org.br/" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline font-semibold" title="Convenção Batista Nacional (abre em nova aba)">Convenção Batista Nacional (CBN)</a>.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-xl bg-surface-cream-light border border-outline-variant/30 flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary text-[22px] mt-0.5">gavel</span>
                            <div>
                                <strong class="text-xs font-bold text-on-surface block">Segurança Jurídica</strong>
                                <span class="text-xs text-text-muted">CNPJ registrado e assembleias regularmente averbadas em cartório.</span>
                            </div>
                        </div>
                        <div class="p-4 rounded-xl bg-surface-cream-light border border-outline-variant/30 flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-[22px] mt-0.5">visibility</span>
                            <div>
                                <strong class="text-xs font-bold text-on-surface block">Prestações Abertas</strong>
                                <span class="text-xs text-text-muted">Conselho fiscal atuante e relatórios apreciados pelos membros.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Document Actions Card -->
                <div class="lg:col-span-5 bg-surface-cream-warm/25 rounded-2xl p-6 border border-outline-variant/40 space-y-4" id="regimento">
                    <h3 class="text-lg font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">description</span>
                        Documentos Fundamentais
                    </h3>
                    <p class="text-xs text-text-muted">
                        Acesse o texto consolidado em formato digital acessível ou faça o download para conferência:
                    </p>

                    <!-- Document Link 1: Estatuto Social -->
                    <div class="p-4 rounded-xl bg-surface-pure border border-outline-variant/40 hover:border-secondary transition-all flex items-center justify-between gap-3 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-surface-cream-warm/50 flex items-center justify-center text-secondary shrink-0">
                                <span class="material-symbols-outlined text-[24px]">article</span>
                            </div>
                            <div>
                                <a href="/estatuto" class="text-sm font-bold text-on-surface group-hover:text-secondary transition-colors block">Estatuto Social</a>
                                <span class="text-xs text-text-muted block">Normas constitucionais e doutrinárias (18 arts.)</span>
                            </div>
                        </div>
                        <a aria-label="Visualizar Estatuto Social" class="p-2 rounded-lg bg-surface-cream-light hover:bg-secondary-container hover:text-on-secondary-container text-on-surface transition-colors" href="/estatuto/xml" title="Download XML do Estatuto">
                            <span class="material-symbols-outlined text-[20px]">download</span>
                        </a>
                    </div>

                    <!-- Document Link 2: Regimento Interno -->
                    <div class="p-4 rounded-xl bg-surface-pure border border-outline-variant/40 hover:border-primary transition-all flex items-center justify-between gap-3 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-secondary-fixed/50 flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined text-[24px]">rule_folder</span>
                            </div>
                            <div>
                                <a href="/regimento" class="text-sm font-bold text-on-surface group-hover:text-primary transition-colors block">Regimento Interno</a>
                                <span class="text-xs text-text-muted block">Diretrizes operacionais e ministérios</span>
                            </div>
                        </div>
                        <a aria-label="Visualizar Regimento Interno" class="p-2 rounded-lg bg-surface-cream-light hover:bg-primary-container hover:text-on-primary-container text-on-surface transition-colors" href="/regimento" title="Visualizar Regimento Interno">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </a>
                    </div>

                    <div class="pt-2 text-center">
                        <span class="text-[11px] text-text-muted flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">lock_open</span>
                            Documentos chancelados pela Secretaria Eclesiástica
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GUAPÓ LOCATION & CONTACT BANNER ("Onde Estamos & Contato") -->
<section class="py-16 md:py-24 bg-surface-pure" id="localizacao">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-surface-cream-warm/40 border border-outline-variant/40 text-secondary text-xs font-bold mb-3">
                <span class="material-symbols-outlined text-[16px]">place</span>
                <span>Localização no Coração de Guapó</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-bold text-on-surface">
                Onde Estamos &amp; Contato
            </h2>
            <p class="text-sm sm:text-base text-text-muted mt-2">
                Estamos prontos para acolher você e sua família. Entre em contato ou venha nos visitar pessoalmente.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Contact Details & Interactive Buttons -->
            <div class="lg:col-span-5 flex flex-col justify-between space-y-6">
                <!-- Address Card -->
                <div class="p-6 rounded-2xl bg-surface-cream-light border border-outline-variant/30 elevation-warm-1">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary text-on-primary flex items-center justify-center shrink-0 shadow-sm">
                            <span class="material-symbols-outlined text-[26px]">location_on</span>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-secondary uppercase tracking-wider block">Endereço da Igreja</span>
                            <h3 class="text-lg font-bold text-on-surface mt-1">IBN da Paz de Guapó</h3>
                            <p class="text-sm text-on-surface mt-1 font-medium leading-relaxed">
                                Rua Presidente Kennedy, Qd. 21, Lt. 13 – Centro<br/>
                                Guapó – GO, CEP 75350-000
                            </p>
                            <span class="inline-block mt-2 text-xs text-text-muted">Próximo à praça central e com estacionamento acessível na via.</span>
                        </div>
                    </div>
                </div>

                <!-- Direct Channel Actions -->
                <div class="space-y-3" id="contato">
                    <!-- WhatsApp CTA -->
                    <a class="w-full flex items-center justify-between p-4 rounded-xl bg-[#25D366] text-surface-pure hover:bg-[#1ebd59] transition-all duration-200 shadow-sm group" href="https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20informa%C3%A7%C3%B5es%20sobre%20a%20IBN%20da%20Paz." rel="noopener noreferrer" target="_blank">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[28px]">chat</span>
                            <div class="text-left">
                                <span class="text-xs opacity-90 block">Atendimento &amp; Pedidos de Oração</span>
                                <strong class="text-sm font-bold block">+55 62 9870-0089</strong>
                            </div>
                        </div>
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">send</span>
                    </a>

                    <!-- Instagram CTA -->
                    <a class="w-full flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-[#833ab4] via-[#fd1d1d] to-[#fcb045] text-surface-pure hover:opacity-95 transition-all duration-200 shadow-sm group" href="https://instagram.com/ibnp_guapo" rel="noopener noreferrer" target="_blank">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[28px]">photo_camera</span>
                            <div class="text-left">
                                <span class="text-xs opacity-90 block">Redes Sociais Oficiais</span>
                                <strong class="text-sm font-bold block">@ibnp_guapo</strong>
                            </div>
                        </div>
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">open_in_new</span>
                    </a>
                </div>

                <!-- Online Donation PIX Card (Mandated Component) -->
                <div class="p-5 rounded-2xl bg-surface-pure border-l-4 border-live-badge border-t border-r border-b border-outline-variant/30 elevation-warm-1">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <span class="text-xs text-primary uppercase tracking-wider block font-bold">Dízimos e Ofertas via PIX</span>
                            <p class="text-xs text-text-muted mt-0.5">CNPJ da Igreja Batista Nacional da Paz de Guapó:</p>
                            <code class="text-base font-bold text-on-surface font-mono tracking-tight block mt-1" id="pixKey">02.930.019/0001-62</code>
                        </div>
                        <button type="button" class="p-2.5 rounded-xl bg-surface-cream-light hover:bg-surface-cream-warm text-secondary border border-outline-variant/50 transition-colors flex items-center gap-1 text-xs font-bold shrink-0" onclick="copyPixKey()" title="Copiar Chave PIX">
                            <span class="material-symbols-outlined text-[18px]">content_copy</span>
                            <span class="hidden sm:inline">Copiar</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Google Maps Cartographic Container -->
            <div class="lg:col-span-7">
                <div class="rounded-2xl overflow-hidden border border-outline-variant/40 elevation-warm-2 bg-surface-pure flex flex-col h-full min-h-[420px]">
                    <!-- Map Canvas Frame -->
                    @include('components.google-map', [
                        'mapId' => 'home-map',
                        'heightClass' => 'flex-grow h-72 sm:h-96 w-full',
                        'title' => 'Templo Sede - IBN da Paz de Guapó'
                    ])

                    <!-- Map Footer Bar with Direct Action -->
                    <div class="p-4 bg-surface-cream-light border-t border-outline-variant/30 flex flex-wrap items-center justify-between gap-3">
                        <div class="text-xs text-text-muted">
                            <strong class="text-on-surface">Coordenadas:</strong> -16.8322, -49.5317 • Centro de Guapó
                        </div>
                        <a class="inline-flex items-center gap-2 bg-primary text-on-primary px-4 py-2 rounded-xl text-xs font-bold hover:bg-secondary-container transition-all active:scale-95 shadow-sm" href="https://maps.google.com/?q=Igreja+Batista+Nacional+da+Paz+Guapo+GO" rel="noopener noreferrer" target="_blank">
                            <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                            <span>Abrir no Google Maps</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT SUMMARY SECTION ("Sobre Nós") -->
<section class="py-16 md:py-20 bg-surface-cream-warm/20 border-t border-outline-variant/20" id="sobre">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1">
                <div class="w-12 h-12 rounded-xl bg-surface-cream-warm/60 text-secondary flex items-center justify-center mb-4 mx-auto md:mx-0">
                    <span class="material-symbols-outlined text-[26px]">favorite</span>
                </div>
                <h3 class="text-lg font-bold text-on-surface mb-2">Comunhão Fraterna</h3>
                <p class="text-xs text-text-muted leading-relaxed">
                    Uma família de fé onde cada membro é acolhido com amor pastoral através de ministérios integrados e edificação recíproca.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1">
                <div class="w-12 h-12 rounded-xl bg-surface-container-high text-primary flex items-center justify-center mb-4 mx-auto md:mx-0">
                    <span class="material-symbols-outlined text-[26px]">auto_stories</span>
                </div>
                <h3 class="text-lg font-bold text-on-surface mb-2">Fidelidade Bíblica</h3>
                <p class="text-xs text-text-muted leading-relaxed">
                    Ensino alicerçado com pureza na Bíblia Sagrada como nossa única regra de fé e prática para conduta ética e salvação em Jesus Cristo.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1">
                <div class="w-12 h-12 rounded-xl bg-secondary-fixed/60 text-secondary flex items-center justify-center mb-4 mx-auto md:mx-0">
                    <span class="material-symbols-outlined text-[26px]">diversity_1</span>
                </div>
                <h3 class="text-lg font-bold text-on-surface mb-2">Serviço à Cidade</h3>
                <p class="text-xs text-text-muted leading-relaxed">
                    Compromisso social, oração contínua pela cidade de Guapó e proclamação das Boas Novas de esperança a todos os lares guapoenses.
                </p>
            </div>
        </div>
    </div>
</section>

<script>
function copyPixKey() {
    navigator.clipboard.writeText('02930019000162').then(function() {
        alert('Chave PIX (CNPJ 02.930.019/0001-62) copiada com sucesso!');
    }).catch(function() {
        prompt('Copie a chave PIX (CNPJ):', '02.930.019/0001-62');
    });
}
</script>
@endsection
