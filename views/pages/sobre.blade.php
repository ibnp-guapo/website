@extends('layouts.app')

@section('title', 'Sobre Nós - IBN da Paz de Guapó')
@section('meta_description', 'Conheça a história, identidade bíblica e filiação da Igreja Batista Nacional da Paz de Guapó-GO, fundada em 14/01/1999.')

@section('content')
    <!-- Header Hero Sobre Nós (Stitch Warm Fellowship) -->
    <section class="relative overflow-hidden py-12 md:py-16 bg-gradient-to-b from-surface-cream-light via-[#FFFDF9] to-surface-cream-light border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl flex flex-col items-start gap-4">
                <div class="inline-flex items-center gap-2 bg-surface-cream-warm/40 border border-outline-variant/60 px-3.5 py-1.5 rounded-full text-on-surface">
                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary">História &amp; Identidade</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-on-surface leading-[1.15] tracking-tight">
                    Sobre a IBN da Paz de Guapó
                </h1>
                <p class="text-base sm:text-lg text-text-muted leading-relaxed">
                    Conheça nossa trajetória de fé, serviço e comunhão cristã no município de Guapó-GO desde 1999.
                </p>
            </div>
        </div>
    </section>

    <!-- Conteúdo Principal -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            
            <!-- Coluna de Texto Principal -->
            <div class="lg:col-span-8 space-y-12">
                <!-- Nossa História -->
                <section>
                    <span class="text-xs font-bold uppercase tracking-widest text-primary">Trajetória Institucional</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight mt-1 mb-6">Fundação e Raízes em Guapó</h2>
                    <div class="prose prose-slate max-w-none text-text-muted leading-relaxed space-y-4">
                        <p>
                            A <strong class="text-on-surface font-bold">Igreja Batista Nacional da Paz de Guapó</strong> foi fundada em <strong class="text-on-surface font-bold">14 de janeiro de 1999</strong>, nascendo do anseio de servos de Deus em plantar uma congregação calorosa, bíblica e acolhedora no coração do município de Guapó, Estado de Goiás.
                        </p>
                        <p>
                            Constituída como pessoa jurídica de direito privado sem fins lucrativos (CNPJ <code class="px-2 py-0.5 rounded bg-surface-cream-warm/40 text-on-surface border border-outline-variant/40 text-xs">02.930.019/0001-62</code>), a igreja teve seus atos constitutivos devidamente averbados no 2º Serviço Notarial da Comarca de Guapó em março de 2002.
                        </p>
                        <p>
                            Desde o início, nossa missão tem sido proclamar o Evangelho da Graça, acolher os cansados e sobrecarregados, discipular gerações e servir ativamente à cidade através do testemunho de amor fraternal.
                        </p>
                    </div>
                </section>

                <!-- Confissão de Fé e Pilares -->
                <section>
                    <span class="text-xs font-bold uppercase tracking-widest text-secondary">Doutrina &amp; Teologia</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight mt-1 mb-6">O Que Cremos</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1 hover:border-secondary transition-all duration-300">
                            <div class="w-10 h-10 rounded-xl bg-surface-cream-warm/50 text-secondary flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-[24px]">menu_book</span>
                            </div>
                            <h3 class="text-lg font-bold text-on-surface mb-2">Escrituras Sagradas</h3>
                            <p class="text-sm text-text-muted leading-relaxed">
                                A Bíblia Sagrada é nossa única regra infalível de fé, prática e disciplina para toda a conduta eclesiástica.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1 hover:border-primary transition-all duration-300">
                            <div class="w-10 h-10 rounded-xl bg-surface-cream-warm/50 text-primary flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-[24px]">auto_awesome</span>
                            </div>
                            <h3 class="text-lg font-bold text-on-surface mb-2">Renovação Espiritual</h3>
                            <p class="text-sm text-text-muted leading-relaxed">
                                Cremos no batismo com o Espírito Santo e na contemporaneidade dos dons espirituais para edificação da igreja.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1 hover:border-secondary transition-all duration-300">
                            <div class="w-10 h-10 rounded-xl bg-surface-cream-warm/50 text-secondary flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-[24px]">cross</span>
                            </div>
                            <h3 class="text-lg font-bold text-on-surface mb-2">Salvação pela Graça</h3>
                            <p class="text-sm text-text-muted leading-relaxed">
                                Proclamamos que a salvação eterna é obtida exclusivamente mediante a fé em Jesus Cristo, nosso Senhor.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1 hover:border-secondary transition-all duration-300">
                            <div class="w-10 h-10 rounded-xl bg-surface-cream-warm/50 text-secondary flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-[24px]">diversity_1</span>
                            </div>
                            <h3 class="text-lg font-bold text-on-surface mb-2">Comunhão Familiar</h3>
                            <p class="text-sm text-text-muted leading-relaxed">
                                Valorizamos a família como instituição divina sagrada, promovendo discipulado de crianças, jovens e casais.
                            </p>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Coluna Lateral de Filiação e Governança -->
            <aside class="lg:col-span-4 space-y-8">
                <!-- Card Filiação Denominacional -->
                <div class="bg-surface-pure rounded-3xl border border-outline-variant/30 p-8 elevation-warm-1">
                    <span class="text-xs font-bold uppercase tracking-widest text-text-muted block mb-3">Vínculo Eclesiástico</span>
                    <h3 class="text-xl font-extrabold text-on-surface mb-4">Filiação Denominacional</h3>
                    <p class="text-sm text-text-muted leading-relaxed mb-6">
                        A IBN da Paz de Guapó é filiada à <strong class="text-on-surface font-bold">Convenção Batista Nacional (CBN)</strong> e à <strong class="text-on-surface font-bold">ORMIBAN Goiás</strong> (Ordem dos Ministros Batistas Nacionais), adotando a Declaração de Fé oficial da denominação.
                    </p>
                    <div class="pt-4 border-t border-outline-variant/30 flex flex-col gap-3 text-xs font-semibold text-on-surface">
                        <div class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-secondary text-[20px]">account_balance</span>
                            <span>Convenção Batista Nacional (CBN)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-secondary text-[20px]">assignment</span>
                            <span>ORMIBAN - Seção de Goiás</span>
                        </div>
                    </div>
                </div>

                <!-- Card Governança Aberta -->
                <div class="bg-surface-cream-warm/30 border border-outline-variant/40 rounded-3xl p-8 elevation-warm-1">
                    <span class="text-xs font-bold uppercase tracking-widest text-secondary block mb-3">Transparência</span>
                    <h3 class="text-xl font-extrabold text-on-surface mb-3">Documentos Constitutivos</h3>
                    <p class="text-xs text-text-muted leading-relaxed mb-6 font-normal">
                        Consulte nosso Estatuto Social averbado em cartório em formato digital semântico Akoma Ntoso 3.0.
                    </p>
                    <a href="/estatuto" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-primary text-on-primary text-xs font-bold shadow-sm hover:bg-secondary-container transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">description</span>
                        <span>Acessar Estatuto Social</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </aside>

        </div>
    </main>
@endsection
