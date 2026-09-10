@extends('layouts.app')

@section('title', 'Contato e Localização - IBN da Paz de Guapó')
@section('meta_description', 'Endereço, WhatsApp, redes sociais e mapa de localização da Igreja Batista Nacional da Paz no Centro de Guapó-GO.')

@section('content')
    <!-- Header Hero Contato -->
    <section class="bg-slate-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-orange-600/30 text-orange-300 border border-orange-500/30 mb-4">
                    📍 Canais Oficiais & Localização
                </span>
                <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4">
                    Entre em Contato Conosco
                </h1>
                <p class="text-slate-300 text-base sm:text-lg leading-relaxed font-light">
                    Estamos à disposição para receber você e sua família, tirar dúvidas e orar pelas suas necessidades. Venha nos fazer uma visita em Guapó-GO!
                </p>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Coluna de Informações e Contatos -->
            <div class="lg:col-span-5 space-y-8">
                <!-- Card Endereço -->
                <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-xs">
                    <span class="text-2xl mb-3 block">🏛️</span>
                    <h3 class="text-xl font-black text-slate-900 mb-2">Templo Sede</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        Rua Presidente Kennedy, Qd. 21, Lt. 13<br>
                        Centro, Guapó – GO<br>
                        CEP: 75350-000
                    </p>
                    <a href="https://maps.google.com/?q=Rua+Presidente+Kennedy+Qd+21+Lt+13+Centro+Guapó+GO" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-ibnp-primary hover:underline">
                        <span>Abrir rota no Google Maps</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>

                <!-- Card WhatsApp -->
                <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-xs">
                    <span class="text-2xl mb-3 block">💬</span>
                    <h3 class="text-xl font-black text-slate-900 mb-2">WhatsApp & Telefone</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-6">
                        Converse diretamente com nossa equipe pastoral para pedidos de oração, aconselhamento ou informações sobre as reuniões.
                    </p>
                    <div class="text-base font-bold text-slate-900 mb-4">
                        📞 (62) 9870-0089
                    </div>
                    <a href="https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20informa%C3%A7%C3%B5es%20sobre%20a%20IBN%20da%20Paz%20de%20Guap%C3%B3." target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-ibnp-primary text-white text-xs font-bold hover:bg-orange-700 transition shadow-sm">
                        <span>Enviar Mensagem no WhatsApp</span>
                    </a>
                </div>

                <!-- Redes Sociais -->
                <div class="p-8 rounded-3xl bg-slate-900 text-white shadow-xs">
                    <h3 class="text-lg font-black text-white mb-4">Redes Sociais Oficiais</h3>
                    <div class="space-y-4 text-xs font-semibold">
                        <a href="https://instagram.com/ibnp_guapo" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-3 rounded-xl bg-slate-800 hover:bg-slate-700 transition">
                            <span class="flex items-center gap-2">
                                <span>📸 Instagram:</span>
                                <span class="text-orange-300">@ibnp_guapo</span>
                            </span>
                            <span class="text-slate-400">&rarr;</span>
                        </a>
                        <a href="https://youtube.com/@ibnpguapo" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-3 rounded-xl bg-slate-800 hover:bg-slate-700 transition">
                            <span class="flex items-center gap-2">
                                <span>▶️ YouTube:</span>
                                <span class="text-orange-300">@ibnpguapo</span>
                            </span>
                            <span class="text-slate-400">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Coluna de Mapa e Orientações -->
            <div class="lg:col-span-7 space-y-8">
                <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-xs">
                    <h3 class="text-2xl font-black text-slate-900 mb-2">Localização no Mapa</h3>
                    <p class="text-sm text-slate-600 mb-6">
                        Estamos localizados no Centro de Guapó-GO, com fácil acesso pela Avenida Principal da cidade e estacionamento no entorno.
                    </p>
                    <div class="rounded-2xl overflow-hidden border border-slate-200 aspect-[4/3] bg-slate-100">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.5!2d-49.5317!3d-16.8315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDQ5JzUzLjQiUyA0OcKwMzEnNTQuMSJX!5e0!3m2!1spt-BR!2sbr!4v1700000000000" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Mapa da Sede da IBN da Paz de Guapó">
                        </iframe>
                    </div>
                </div>

                <!-- Resumo de Cultos para Visitantes -->
                <div class="p-8 rounded-3xl bg-orange-50/60 border border-orange-200/80">
                    <span class="text-xs font-bold uppercase tracking-widest text-ibnp-primary">Horários das Reuniões</span>
                    <h4 class="text-xl font-black text-slate-900 mt-1 mb-4">Esperamos por Você!</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-semibold text-slate-700">
                        <div class="p-3 bg-white rounded-xl border border-orange-200/50">
                            <span class="block text-ibnp-primary font-black uppercase mb-1">Quartas-feiras</span>
                            <span>19:30 às 21:00 • Oração e Estudo</span>
                        </div>
                        <div class="p-3 bg-white rounded-xl border border-orange-200/50">
                            <span class="block text-ibnp-primary font-black uppercase mb-1">Domingos</span>
                            <span>19:30 às 21:00 • Celebração da Família</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
