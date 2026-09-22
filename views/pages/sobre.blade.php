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

                <!-- Responsabilidade Social & Mantenedora -->
                <section>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-cream-warm/40 text-secondary text-xs font-bold mb-3 border border-outline-variant/30">
                        <span class="material-symbols-outlined text-[16px]">volunteer_activism</span>
                        <span>Iniciativa Comunitária &amp; Ação Social</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight mt-1 mb-6">Mantenedora da Escola Social de Guapó</h2>
                    <div class="prose prose-slate max-w-none text-text-muted leading-relaxed space-y-4">
                        <p>
                            Entendemos que a fé cristã genuína se expressa no amor prático e no serviço à comunidade. Como parte integral de sua vocação institucional e cidadã no município de Guapó, a IBN da Paz é a entidade mantenedora legal da <strong class="text-on-surface font-bold">Escola Social de Guapó</strong>.
                        </p>
                        <p>
                            A instituição atua no acolhimento e suporte continuado a crianças e famílias de Guapó, promovendo educação infantil de qualidade, reforço pedagógico no contraturno escolar, oficinas culturais e artísticas, além de um centro comunitário com auditório multiuso aberto a projetos de integração humana, cidadania e convivência social.
                        </p>
                    </div>
                    <div class="mt-6 p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 elevation-warm-1 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-surface-cream-warm/50 text-secondary flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[24px]">volunteer_activism</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-on-surface">Escola Social de Guapó</h3>
                                <p class="text-xs text-text-muted">Iniciativa comunitária • Educação infantil, contraturno e centro comunitário</p>
                            </div>
                        </div>
                        <a href="https://social.ibnpguapo.org.br/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-secondary text-on-secondary text-xs font-bold shadow-sm hover:bg-secondary/90 transition-all active:scale-95 whitespace-nowrap" title="Conhecer o projeto da Escola Social de Guapó (abre em nova aba)">
                            <span>Conhecer o Projeto Social</span>
                            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                        </a>
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

                <!-- Ficha Cadastral e Transparência Jurídica (Spec 14 - Google for Nonprofits) -->
                <section class="mt-12 pt-8 border-t border-outline-variant/30">
                    <span class="text-xs font-bold uppercase tracking-widest text-secondary">Transparência &amp; Identificação Oficial</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight mt-1 mb-6">Ficha Cadastral e Transparência Jurídica</h2>
                    
                    <div class="bg-surface-pure rounded-3xl border border-outline-variant/30 p-6 sm:p-8 elevation-warm-1">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                            <div class="p-4 rounded-xl bg-surface-cream-light border border-outline-variant/30">
                                <span class="text-text-muted block text-[11px] uppercase font-bold tracking-wider">Razão Social Oficial</span>
                                <strong class="text-on-surface font-bold text-sm block mt-0.5">Igreja Batista Nacional da Paz de Guapó</strong>
                            </div>
                            <div class="p-4 rounded-xl bg-surface-cream-light border border-outline-variant/30">
                                <span class="text-text-muted block text-[11px] uppercase font-bold tracking-wider">Cadastro Nacional de Pessoa Jurídica (CNPJ)</span>
                                <strong class="text-secondary font-bold text-sm block mt-0.5">02.930.019/0001-62</strong>
                            </div>
                            <div class="p-4 rounded-xl bg-surface-cream-light border border-outline-variant/30">
                                <span class="text-text-muted block text-[11px] uppercase font-bold tracking-wider">Data de Fundação</span>
                                <strong class="text-on-surface font-bold text-sm block mt-0.5">14 de janeiro de 1999</strong>
                            </div>
                            <div class="p-4 rounded-xl bg-surface-cream-light border border-outline-variant/30">
                                <span class="text-text-muted block text-[11px] uppercase font-bold tracking-wider">Natureza Jurídica</span>
                                <strong class="text-on-surface font-bold text-sm block mt-0.5">322-0 - Organização Religiosa Sem Fins Lucrativos</strong>
                            </div>
                            <div class="p-4 rounded-xl bg-surface-cream-light border border-outline-variant/30 sm:col-span-2">
                                <span class="text-text-muted block text-[11px] uppercase font-bold tracking-wider">Sede e Endereço Físico</span>
                                <strong class="text-on-surface font-bold text-sm block mt-0.5">Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro, Guapó – GO, CEP 75350-000</strong>
                            </div>
                            <div class="p-4 rounded-xl bg-surface-cream-warm/30 border border-outline-variant/40 sm:col-span-2">
                                <span class="text-secondary block text-[11px] uppercase font-bold tracking-wider">Titularidade e Operação do Domínio Oficial</span>
                                <p class="text-xs text-on-surface leading-relaxed mt-1">
                                    O domínio <strong class="font-bold">ibnpguapo.org.br</strong> é o endereço web oficial de titularidade, registro e operação exclusiva da <strong class="font-bold">Igreja Batista Nacional da Paz de Guapó</strong>. Qualquer comunicação oficial ou canal digital associado a este domínio responde perante esta pessoa jurídica registrada.
                                </p>
                                <div class="mt-3 pt-2 border-t border-outline-variant/30 flex items-center gap-2 text-xs font-semibold text-secondary">
                                    <span class="material-symbols-outlined text-[16px]">mail</span>
                                    <span>Canal Oficial de E-mail: <a href="mailto:contato@ibnpguapo.org.br" class="text-primary hover:underline font-bold">contato@ibnpguapo.org.br</a></span>
                                </div>
                            </div>
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
                        A IBN da Paz de Guapó é filiada à <a href="https://cbn.org.br/" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline font-bold" title="Acessar portal oficial da Convenção Batista Nacional (abre em nova aba)">Convenção Batista Nacional (CBN)</a> e à <a href="https://ormiban.org.br/site/" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline font-bold" title="Acessar portal oficial da ORMIBAN (abre em nova aba)">ORMIBAN Goiás</a> (Ordem dos Ministros Batistas Nacionais), adotando a Declaração de Fé oficial da denominação.
                    </p>
                    <div class="pt-4 border-t border-outline-variant/30 flex flex-col gap-3 text-xs font-semibold text-on-surface">
                        <a href="https://cbn.org.br/" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-3 rounded-xl bg-surface-cream-light hover:bg-surface-cream-warm border border-outline-variant/30 text-on-surface hover:text-primary transition-all group" title="Visitar portal oficial da CBN (abre em nova aba)">
                            <span class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-secondary text-[20px]">account_balance</span>
                                <span>Convenção Batista Nacional (CBN)</span>
                            </span>
                            <span class="material-symbols-outlined text-[16px] text-text-muted group-hover:text-primary group-hover:translate-x-0.5 transition-all">open_in_new</span>
                        </a>
                        <a href="https://ormiban.org.br/site/" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-3 rounded-xl bg-surface-cream-light hover:bg-surface-cream-warm border border-outline-variant/30 text-on-surface hover:text-primary transition-all group" title="Visitar portal oficial da ORMIBAN (abre em nova aba)">
                            <span class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-secondary text-[20px]">assignment</span>
                                <span>ORMIBAN (Ordem dos Ministros)</span>
                            </span>
                            <span class="material-symbols-outlined text-[16px] text-text-muted group-hover:text-primary group-hover:translate-x-0.5 transition-all">open_in_new</span>
                        </a>
                    </div>
                </div>

                <!-- Card Escola Social Mantida -->
                <div class="bg-surface-pure rounded-3xl border border-outline-variant/30 p-8 elevation-warm-1">
                    <span class="text-xs font-bold uppercase tracking-widest text-secondary block mb-3">Ação Comunitária</span>
                    <h3 class="text-xl font-extrabold text-on-surface mb-3">Escola Social de Guapó</h3>
                    <p class="text-xs text-text-muted leading-relaxed mb-6 font-normal">
                        Conheça os projetos e iniciativas de acolhimento social mantidos pela igreja para a infância e as famílias de Guapó.
                    </p>
                    <a href="https://social.ibnpguapo.org.br/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-primary text-on-primary text-xs font-bold shadow-sm hover:bg-secondary-container transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">volunteer_activism</span>
                        <span>Conhecer o Projeto Social</span>
                        <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                    </a>
                </div>

                <!-- Card Governança Aberta -->
                <div class="bg-surface-cream-warm/30 border border-outline-variant/40 rounded-3xl p-8 elevation-warm-1">
                    <span class="text-xs font-bold uppercase tracking-widest text-secondary block mb-3">Transparência</span>
                    <h3 class="text-xl font-extrabold text-on-surface mb-3">Documentos Constitutivos</h3>
                    <p class="text-xs text-text-muted leading-relaxed mb-6 font-normal">
                        Consulte nosso Estatuto Social averbado em cartório em formato digital e interativo.
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
