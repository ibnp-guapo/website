@extends('layouts.app')

@section('title', 'Sobre Nós - IBN da Paz de Guapó')
@section('meta_description', 'Conheça a história, identidade bíblica e filiação da Igreja Batista Nacional da Paz de Guapó-GO, fundada em 14/01/1999.')

@section('content')
    <!-- Header Hero Sobre Nós -->
    <section class="bg-slate-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-orange-600/30 text-orange-300 border border-orange-500/30 mb-4">
                    História & Identidade
                </span>
                <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4">
                    Sobre a IBN da Paz de Guapó
                </h1>
                <p class="text-slate-300 text-base sm:text-lg leading-relaxed font-light">
                    Conheça nossa trajetória de fé, serviço e comunhão cristã no município de Guapó-GO desde 1999.
                </p>
            </div>
        </div>
    </section>

    <!-- Conteúdo Principal -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Coluna de Texto Principal -->
            <div class="lg:col-span-8 space-y-12">
                <!-- Nossa História -->
                <section>
                    <span class="text-xs font-bold uppercase tracking-widest text-ibnp-primary">Trajetória Institucional</span>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-1 mb-6">Fundação e Raízes em Guapó</h2>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed space-y-4">
                        <p>
                            A <strong>Igreja Batista Nacional da Paz de Guapó</strong> foi fundada em <strong>14 de janeiro de 1999</strong>, nascendo do anseio de servos de Deus em plantar uma congregação calorosa, bíblica e acolhedora no coração do município de Guapó, Estado de Goiás.
                        </p>
                        <p>
                            Constituída como pessoa jurídica de direito privado sem fins lucrativos (CNPJ <code>02.930.019/0001-62</code>), a igreja teve seus atos constitutivos devidamente averbados no 2º Serviço Notarial da Comarca de Guapó em março de 2002.
                        </p>
                        <p>
                            Desde o início, nossa missão tem sido proclamar o Evangelho da Graça, acolher os cansados e sobrecarregados, discipular gerações e servir ativamente à cidade através do testemunho de amor fraternal.
                        </p>
                    </div>
                </section>

                <!-- Confissão de Fé e Pilares -->
                <section>
                    <span class="text-xs font-bold uppercase tracking-widest text-ibnp-secondary">Doutrina & Teologia</span>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-1 mb-6">O Que Cremos</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs">
                            <span class="text-2xl mb-3 block">📖</span>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Escrituras Sagradas</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                A Bíblia Sagrada é nossa única regra infalível de fé, prática e disciplina para toda a conduta eclesiástica.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs">
                            <span class="text-2xl mb-3 block">🕊️</span>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Renovação Espiritual</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Cremos no batismo com o Espírito Santo e na contemporaneidade dos dons espirituais para edificação da igreja.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs">
                            <span class="text-2xl mb-3 block">✝️</span>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Salvação pela Graça</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Proclamamos que a salvação eterna é obtida exclusivamente mediante a fé em Jesus Cristo, nosso Senhor.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs">
                            <span class="text-2xl mb-3 block">🤝</span>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Comunhão Familiar</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Valorizamos a família como instituição divina sagrada, promovendo discipulado de crianças, jovens e casais.
                            </p>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Coluna Lateral de Filiação e Governança -->
            <aside class="lg:col-span-4 space-y-8">
                <!-- Card Filiação Denominacional -->
                <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-xs">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-400 block mb-3">Vínculo Eclesiástico</span>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Filiação Denominacional</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-6">
                        A IBN da Paz de Guapó é filiada à <strong>Convenção Batista Nacional (CBN)</strong> e à <strong>ORMIBAN Goiás</strong> (Ordem dos Ministros Batistas Nacionais), adotando a Declaração de Fé oficial da denominação.
                    </p>
                    <div class="pt-4 border-t border-slate-100 flex flex-col gap-2 text-xs font-semibold text-slate-700">
                        <span>🏛️ Convenção Batista Nacional (CBN)</span>
                        <span>📋 ORMIBAN - Seção de Goiás</span>
                    </div>
                </div>

                <!-- Card Governança Aberta -->
                <div class="bg-slate-900 text-white rounded-3xl p-8 shadow-xs">
                    <span class="text-xs font-bold uppercase tracking-widest text-orange-400 block mb-3">Transparência</span>
                    <h3 class="text-xl font-black text-white mb-3">Documentos Constitutivos</h3>
                    <p class="text-xs text-slate-300 leading-relaxed mb-6 font-light">
                        Consulte nosso Estatuto Social averbado em cartório em formato digital semântico Akoma Ntoso 3.0.
                    </p>
                    <a href="/estatuto" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-ibnp-primary text-white text-xs font-bold hover:bg-orange-700 transition">
                        <span>Acessar Estatuto Social</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </aside>

        </div>
    </main>
@endsection
