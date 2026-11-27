@extends('layouts.app')

@section('title', 'Ação Social & Projetos Comunitários | IBNP')
@section('meta_description', 'Conheça as ações sociais da IBNP em Guapó-GO (Natal Sem Fome, Coral de Natal Infantil e Guia de Chegada) e a Escola Nova Esperança, que apoiamos em Angola.')

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
                    Ação Social &amp; Cuidado com a Infância
                </h1>
                <p class="text-base sm:text-lg text-text-muted leading-relaxed">
                    Acreditamos que a fé cristã se manifesta concretamente no cuidado ao próximo, na valorização da família e na proteção da infância. Conheça as ações que realizamos em Guapó e a obra que apoiamos internacionalmente.
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
                    <span class="text-xs font-bold text-secondary uppercase tracking-wider block">Cuidado com a Infância</span>
                    <p class="text-xs text-text-muted mt-1 leading-relaxed">Atividades gratuitas de música e convivência, como o Coral de Natal Infantil.</p>
                </div>

                <div class="p-6 rounded-2xl bg-surface-cream-light/60 border border-outline-variant/30">
                    <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-[22px]">volunteer_activism</span>
                    </div>
                    <span class="text-xs font-bold text-secondary uppercase tracking-wider block">Ação Local</span>
                    <p class="text-xs text-text-muted mt-1 leading-relaxed">Campanhas solidárias e orientação gratuita às famílias de Guapó.</p>
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
                Cada iniciativa expressa nosso chamado e compromisso comunitário: servimos diretamente as famílias da nossa cidade e cooperamos com ofertas regulares com uma obra educacional no continente africano.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 items-stretch">
            <!-- Projeto 1: Ações Sociais em Guapó (realizadas pela IBNP) -->
            <article class="bg-surface-pure rounded-3xl border border-outline-variant/30 p-8 sm:p-10 elevation-warm-1 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/5 rounded-bl-full pointer-events-none"></div>
                <div>
                    <!-- Badge de Papel da IBNP -->
                    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-secondary/15 text-secondary text-xs font-extrabold uppercase tracking-wide">
                            <span class="material-symbols-outlined text-[16px]">verified</span>
                            <span>Realizadas pela IBNP</span>
                        </span>
                        <span class="text-xs font-semibold text-text-muted flex items-center gap-1">
                            <span class="material-symbols-outlined text-[15px] text-primary">location_on</span>
                            <span>Guapó, Goiás • Brasil</span>
                        </span>
                    </div>

                    <h3 class="text-2xl sm:text-3xl font-extrabold text-on-surface mb-3 tracking-tight">
                        Ações Sociais em Guapó
                    </h3>

                    <p class="text-xs sm:text-sm text-secondary font-bold mb-4 uppercase tracking-wider">
                        Cuidado com as Famílias &amp; a Infância
                    </p>

                    <p class="text-sm text-text-muted leading-relaxed mb-6 font-normal">
                        A <strong class="text-on-surface">Igreja Batista Nacional da Paz de Guapó (IBNP)</strong> serve a cidade com campanhas solidárias, atividades gratuitas para as crianças e orientação para as famílias, em parceria com a rede de assistência social do município.
                    </p>

                    <!-- Lista de Ações e Escopo -->
                    <div class="space-y-3 mb-8">
                        <div class="flex items-start gap-3 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5">check_circle</span>
                            <span><strong>Natal Sem Fome:</strong> campanha de cestas básicas para famílias em vulnerabilidade cadastradas no CRAS de Guapó.</span>
                        </div>
                        <div class="flex items-start gap-3 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5">check_circle</span>
                            <span><strong>Coral de Natal Infantil:</strong> iniciação vocal e canto coral gratuitos para crianças de 5 a 12 anos.</span>
                        </div>
                        <div class="flex items-start gap-3 text-xs sm:text-sm text-on-surface">
                            <span class="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5">check_circle</span>
                            <span><strong>Orientação às famílias:</strong> Guia de Chegada e blog com informações sobre documentos, escola, Cadastro Único e benefícios.</span>
                        </div>
                    </div>

                    <!-- Destaque: Natal Sem Fome -->
                    <div id="natal-sem-fome" class="p-4 rounded-2xl bg-surface-cream-warm/50 border border-outline-variant/40 mb-4 space-y-1 scroll-mt-28">
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider text-primary">
                            <span class="material-symbols-outlined text-[14px]">volunteer_activism</span>
                            <span>Campanha Natal Sem Fome • Dezembro 2026</span>
                        </span>
                        <p class="text-xs font-bold text-on-surface">Meta: 50 cestas básicas para famílias atendidas pelo CRAS</p>
                        <p class="text-[11px] text-text-muted">Doe R$ 5,20 pelo Pix, chave CNPJ <strong class="text-on-surface">02.930.019/0001-62</strong> (Igreja Batista Nacional da Paz de Guapó). Vai doar outro valor? Avise a igreja pelo WhatsApp, para a doação ir para a campanha.</p>
                    </div>
                    <!-- Destaque: Coral de Natal (próxima edição) -->
                    <div class="p-4 rounded-2xl bg-surface-cream-warm/50 border border-outline-variant/40 mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div class="space-y-0.5">
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider text-secondary">
                                <span class="material-symbols-outlined text-[14px]">music_note</span>
                                <span>Próxima edição • Dezembro de 2027</span>
                            </span>
                            <p class="text-xs font-bold text-on-surface">Coral de Natal Infantil (30 vagas gratuitas)</p>
                            <p class="text-[11px] text-text-muted">Iniciação vocal e canto coral para crianças de 5 a 12 anos em Guapó.</p>
                        </div>
                        <a href="/coral-natal" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-secondary text-on-secondary text-xs font-bold shadow-sm hover:bg-secondary/90 transition-all active:scale-95 whitespace-nowrap shrink-0">
                            <span>Saiba mais</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
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

                    <!-- Destaque Fotográfico: Missão em Campo -->
                    <figure class="rounded-2xl bg-surface-cream-warm/50 border border-outline-variant/40 mb-6 overflow-hidden">
                        <a href="/assets/images/escola-nova-esperanca-angola.jpg" target="_blank" rel="noopener noreferrer" class="group relative block overflow-hidden aspect-[16/9]" title="Clique para ampliar a fotografia oficial">
                            <img
                                src="/assets/images/escola-nova-esperanca-angola.jpg"
                                alt="Alunos uniformizados e liderança da Escola Nova Esperança em Angola"
                                width="960"
                                height="720"
                                loading="lazy"
                                decoding="async"
                                class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300"
                            />
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white">
                                <span class="material-symbols-outlined text-[28px]">zoom_in</span>
                            </div>
                        </a>
                        <figcaption class="p-4 space-y-1">
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider text-primary">
                                <span class="material-symbols-outlined text-[14px]">photo_camera</span>
                                <span>Missão em Campo • Angola</span>
                            </span>
                            <p class="text-xs sm:text-sm font-bold text-on-surface leading-snug">Alunos atendidos e liderança missionária</p>
                            <p class="text-xs text-text-muted leading-relaxed">Crianças uniformizadas e liderança da Escola Nova Esperança. Clique na foto para ver em alta resolução.</p>
                        </figcaption>
                    </figure>
                </div>

                <!-- Acesso ao Portal Oficial do Projeto Social Apoiado -->
                <div class="pt-6 border-t border-outline-variant/30 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-2 text-xs text-text-muted">
                        <span class="material-symbols-outlined text-primary text-[18px]">public</span>
                        <span>Iniciativa da <strong>IMNE</strong> (Missão Nova Esperança)</span>
                    </div>
                    <a href="https://social.imne.ao/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary text-on-primary text-xs font-bold shadow-sm hover:bg-secondary-container transition-all active:scale-95 whitespace-nowrap shrink-0" title="Visitar portal oficial da Escola Nova Esperança em Angola (abre em nova aba)">
                        <span>Conhecer o Projeto</span>
                        <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                    </a>
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
                        <a href="https://wa.me/5562998700089?text=Ol%C3%A1!%20Gostaria%20de%20saber%20como%20posso%20apoiar%20os%20projetos%20sociais%20da%20IBNP." target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-[#25D366] text-white text-xs font-bold shadow-sm hover:opacity-95 transition-all active:scale-95">
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
