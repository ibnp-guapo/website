@extends('layouts.app')

@section('title', 'IBN da Paz de Guapó - Um Lugar de Recomeço, Fé e Comunhão')
@section('meta_description', 'Portal oficial da Igreja Batista Nacional da Paz de Guapó-GO. Cultos semanais às quartas e domingos às 19:30. Venha celebrar conosco!')

@section('content')
    <!-- Hero Section de Acolhimento -->
    <section class="relative bg-gradient-to-b from-white via-orange-50/30 to-slate-50 border-b border-slate-200 py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-orange-100 text-ibnp-primary border border-orange-200 mb-6">
                    🕊️ Um Lugar de Paz e Recomeço
                </div>
                <h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-[1.1] mb-6">
                    Uma igreja acolhedora para você e sua família em <span class="text-ibnp-primary">Guapó</span>
                </h1>
                <p class="text-lg sm:text-xl text-slate-600 leading-relaxed font-normal mb-10 max-w-2xl">
                    Seja bem-vindo à Igreja Batista Nacional da Paz. Aqui você encontra uma família de fé comprometida com o Evangelho, a oração e a transformação de vidas pelo amor de Jesus Cristo.
                </p>
                <div class="flex items-center gap-4 flex-wrap">
                    <a href="/programacao" class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-2xl bg-ibnp-primary text-white text-sm font-bold hover:bg-orange-700 transition-all shadow-md hover:shadow-lg">
                        <span>Ver Cultos & Horários</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                    <a href="/contato" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-white border border-slate-200 text-slate-700 text-sm font-bold hover:bg-slate-50 transition shadow-xs">
                        <span>Como Chegar</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Widget Cultos da Semana -->
    <section class="py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-ibnp-primary">Reuniões Presenciais</span>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-1">Cultos da Semana</h2>
                </div>
                <a href="/programacao" class="inline-flex items-center gap-1.5 text-sm font-bold text-ibnp-primary hover:text-orange-700 transition">
                    <span>Ver programação detalhada & calendário</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card Quarta -->
                <div class="rounded-3xl border border-slate-200 p-8 bg-slate-50/50 hover:bg-white hover:border-slate-300 transition-all shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-black uppercase tracking-wider text-ibnp-secondary bg-orange-100 px-3 py-1 rounded-full">
                                Quarta-feira
                            </span>
                            <span class="text-xs font-semibold text-slate-500 bg-white border border-slate-200 px-2.5 py-1 rounded-full">
                                90 min
                            </span>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 mb-2">Culto de Oração e Estudo Bíblico</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            Reunião congregacional dedicada à intercessão pelas famílias, saúde espiritual e estudo expositivo das Sagradas Escrituras.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-200/60 flex items-center justify-between">
                        <span class="text-sm font-bold text-slate-800">⏰ 19:30 às 21:00</span>
                        <a href="/programacao" class="text-xs font-bold text-ibnp-primary hover:underline">Detalhes &rarr;</a>
                    </div>
                </div>

                <!-- Card Domingo -->
                <div class="rounded-3xl border border-slate-200 p-8 bg-slate-50/50 hover:bg-white hover:border-slate-300 transition-all shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-black uppercase tracking-wider text-ibnp-primary bg-red-100 px-3 py-1 rounded-full">
                                Domingo
                            </span>
                            <span class="text-xs font-semibold text-slate-500 bg-white border border-slate-200 px-2.5 py-1 rounded-full">
                                90 min
                            </span>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 mb-2">Celebração da Família</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            Culto solene com louvor congregacional, adoração sincera e proclamação da Palavra de Deus edificando todas as gerações da igreja.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-200/60 flex items-center justify-between">
                        <span class="text-sm font-bold text-slate-800">⏰ 19:30 às 21:00</span>
                        <a href="/programacao" class="text-xs font-bold text-ibnp-primary hover:underline">Detalhes &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Governança e Transparência Aberta -->
    <section class="py-16 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-orange-400">Governança Digital & Transparência</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mt-1 mb-4">
                    Estatuto e Regimento em Formato Aberto
                </h2>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light">
                    A IBN da Paz de Guapó adota o padrão internacional <strong>OASIS LegalDocML Akoma Ntoso 3.0</strong>, garantindo acesso público e auditabilidade irrestrita de suas normas constitutivas, registradas em cartório.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card Estatuto -->
                <div class="bg-slate-800/90 rounded-3xl p-8 border border-slate-700 hover:border-orange-500/50 transition">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-2xl">📜</span>
                        <span class="text-xs font-bold uppercase tracking-wider text-orange-400 bg-orange-950/60 px-2.5 py-0.5 rounded-full border border-orange-800/40">Averbado em Cartório</span>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">Estatuto Social</h3>
                    <p class="text-slate-300 text-sm leading-relaxed mb-6 font-light">
                        18 artigos consolidados disciplinando denominação, fins, direitos e deveres dos membros, governo eclesiástico e patrimônio.
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="/estatuto" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-ibnp-primary text-white text-xs font-bold hover:bg-orange-700 transition">
                            <span>Abrir Leitor Interativo</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="/estatuto/xml" class="inline-flex items-center gap-1.5 px-3 py-2.5 rounded-xl bg-slate-700 text-slate-300 text-xs font-semibold hover:bg-slate-600 transition">
                            <span>Download XML</span>
                        </a>
                    </div>
                </div>

                <!-- Card Regimento -->
                <div class="bg-slate-800/90 rounded-3xl p-8 border border-slate-700 hover:border-orange-500/50 transition">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-2xl">⚖️</span>
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-400 bg-amber-950/60 px-2.5 py-0.5 rounded-full border border-amber-800/40">Normas Internas</span>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">Regimento Interno</h3>
                    <p class="text-slate-300 text-sm leading-relaxed mb-6 font-light">
                        Regulamentação prática das rotinas litúrgicas, departamentos, ministérios e funcionamento diário da congregação.
                    </p>
                    <div>
                        <a href="/regimento" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-700 text-white text-xs font-bold hover:bg-slate-600 transition">
                            <span>Consultar Regimento</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Localização em Guapó-GO -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5">
                    <span class="text-xs font-bold uppercase tracking-widest text-ibnp-primary">Venha nos Visitar</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-1 mb-6">
                        Nossa Sede em Guapó
                    </h2>
                    <div class="space-y-4 text-sm text-slate-600 leading-relaxed mb-8">
                        <p class="flex items-start gap-3">
                            <span class="text-lg">📍</span>
                            <span><strong>Endereço:</strong> Rua Presidente Kennedy, Qd. 21, Lt. 13 – Centro, Guapó – GO, CEP 75350-000</span>
                        </p>
                        <p class="flex items-start gap-3">
                            <span class="text-lg">📞</span>
                            <span><strong>WhatsApp / Fone:</strong> (62) 9870-0089</span>
                        </p>
                        <p class="flex items-start gap-3">
                            <span class="text-lg">⏰</span>
                            <span><strong>Horários de Culto:</strong> Quartas às 19:30 e Domingos às 19:30</span>
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20informa%C3%A7%C3%B5es%20sobre%20a%20IBN%20da%20Paz." target="_blank" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-ibnp-primary text-white text-xs font-bold hover:bg-orange-700 transition shadow-sm">
                            <span>Conversar no WhatsApp</span>
                        </a>
                        <a href="/contato" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 text-xs font-bold hover:bg-slate-50 transition">
                            <span>Ver Página de Contato</span>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-sm aspect-video bg-slate-200">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.5!2d-49.5317!3d-16.8315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDQ5JzUzLjQiUyA0OcKwMzEnNTQuMSJX!5e0!3m2!1spt-BR!2sbr!4v1700000000000" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Localização da IBN da Paz de Guapó">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
