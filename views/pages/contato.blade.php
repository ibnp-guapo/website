@extends('layouts.app')

@section('title', 'Contato e Localização - IBN da Paz de Guapó')
@section('meta_description', 'Endereço, WhatsApp, redes sociais e mapa de localização da Igreja Batista Nacional da Paz no Centro de Guapó-GO.')

@section('content')
    <!-- Header Hero Contato (Stitch Warm Fellowship) -->
    <section class="relative overflow-hidden py-12 md:py-16 bg-gradient-to-b from-surface-cream-light via-[#FFFDF9] to-surface-cream-light border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl flex flex-col items-start gap-4">
                <div class="inline-flex items-center gap-2 bg-surface-cream-warm/40 border border-outline-variant/60 px-3.5 py-1.5 rounded-full text-on-surface">
                    <span class="material-symbols-outlined text-secondary text-[16px]">location_on</span>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary">Canais Oficiais &amp; Localização</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-on-surface leading-[1.15] tracking-tight">
                    Entre em Contato Conosco
                </h1>
                <p class="text-base sm:text-lg text-text-muted leading-relaxed">
                    Estamos à disposição para receber você e sua família, tirar dúvidas e orar pelas suas necessidades. Venha nos fazer uma visita em Guapó-GO!
                </p>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            
            <!-- Coluna de Informações e Contatos -->
            <div class="lg:col-span-5 space-y-8">
                <!-- Card Endereço -->
                <div class="p-8 rounded-3xl bg-surface-pure border border-outline-variant/30 elevation-warm-1">
                    <div class="w-10 h-10 rounded-xl bg-surface-cream-warm/50 text-secondary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">church</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-on-surface mb-2">Templo Sede</h3>
                    <p class="text-sm text-text-muted leading-relaxed mb-4">
                        Rua Presidente Kennedy, Qd. 21, Lt. 13<br>
                        Centro, Guapó – GO<br>
                        CEP: 75350-000
                    </p>
                    <a href="https://maps.google.com/?q=Rua+Presidente+Kennedy+Qd+21+Lt+13+Centro+Guapó+GO" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-secondary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[16px]">directions</span>
                        <span>Abrir rota no Google Maps</span>
                    </a>
                </div>

                <!-- Card WhatsApp -->
                <div class="p-8 rounded-3xl bg-surface-pure border border-outline-variant/30 elevation-warm-1">
                    <div class="w-10 h-10 rounded-xl bg-surface-cream-warm/50 text-secondary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">chat</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-on-surface mb-2">WhatsApp &amp; Telefone</h3>
                    <p class="text-sm text-text-muted leading-relaxed mb-6">
                        Converse diretamente com nossa equipe pastoral para pedidos de oração, aconselhamento ou informações sobre as reuniões.
                    </p>
                    <div class="flex items-center gap-2 text-base font-bold text-on-surface mb-6">
                        <span class="material-symbols-outlined text-secondary text-[20px]">call</span>
                        <span>(62) 9870-0089</span>
                    </div>
                    <a href="https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20informa%C3%A7%C3%B5es%20sobre%20a%20IBN%20da%20Paz%20de%20Guap%C3%B3." target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-primary text-on-primary text-xs sm:text-sm font-bold shadow-md hover:bg-secondary-container transition-all active:scale-95 w-full sm:w-auto">
                        <span class="material-symbols-outlined text-[18px]">chat</span>
                        <span>Enviar Mensagem no WhatsApp</span>
                    </a>
                </div>

                <!-- Card E-mail Institucional (Spec 14 - Google for Nonprofits) -->
                <div class="p-8 rounded-3xl bg-surface-pure border border-outline-variant/30 elevation-warm-1">
                    <div class="w-10 h-10 rounded-xl bg-surface-cream-warm/50 text-primary flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">mail</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-on-surface mb-2">E-mail Institucional</h3>
                    <p class="text-sm text-text-muted leading-relaxed mb-4">
                        Canal oficial para correspondências institucionais, parcerias, solicitações de certidões e contato administrativo com a diretoria da igreja.
                    </p>
                    <div class="flex items-center gap-2 text-base font-bold text-on-surface mb-6">
                        <span class="material-symbols-outlined text-primary text-[20px]">alternate_email</span>
                        <a href="mailto:contato@ibnpguapo.org.br" class="hover:text-primary transition-colors text-on-surface hover:underline">contato@ibnpguapo.org.br</a>
                    </div>
                    <a href="mailto:contato@ibnpguapo.org.br" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-surface-pure border border-primary text-primary text-xs sm:text-sm font-bold shadow-xs hover:bg-primary hover:text-on-primary transition-all active:scale-95 w-full sm:w-auto">
                        <span class="material-symbols-outlined text-[18px]">send</span>
                        <span>Escrever para contato@ibnpguapo.org.br</span>
                    </a>
                </div>

                <!-- Redes Sociais -->
                <div class="p-8 rounded-3xl bg-surface-pure border border-outline-variant/30 elevation-warm-1">
                    <h3 class="text-lg font-extrabold text-on-surface mb-4">Redes Sociais Oficiais</h3>
                    <div class="space-y-3">
                        <a href="https://instagram.com/ibnp_guapo" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-3.5 rounded-xl bg-surface-cream-light border border-outline-variant/30 hover:border-secondary transition-all text-on-surface group">
                            <span class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-secondary text-[20px]">photo_camera</span>
                                <span class="text-xs font-semibold">Instagram: <strong class="text-secondary font-bold">@ibnp_guapo</strong></span>
                            </span>
                            <span class="material-symbols-outlined text-text-muted group-hover:text-primary text-[18px] transition-colors">arrow_forward</span>
                        </a>
                        <a href="https://youtube.com/@ibnpguapo" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-3.5 rounded-xl bg-surface-cream-light border border-outline-variant/30 hover:border-secondary transition-all text-on-surface group">
                            <span class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-primary text-[20px]">play_circle</span>
                                <span class="text-xs font-semibold">YouTube: <strong class="text-secondary font-bold">@ibnpguapo</strong></span>
                            </span>
                            <span class="material-symbols-outlined text-text-muted group-hover:text-primary text-[18px] transition-colors">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card Titularidade do Domínio -->
                <div class="p-6 rounded-2xl bg-surface-cream-warm/30 border border-outline-variant/40">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary text-[22px] mt-0.5">verified</span>
                        <div>
                            <strong class="text-xs font-bold text-on-surface block">Domínio Oficial Verificado</strong>
                            <p class="text-xs text-text-muted leading-relaxed mt-1">
                                O domínio <strong class="text-on-surface font-semibold">ibnpguapo.org.br</strong> e este portal são de propriedade e operação exclusiva da <strong class="text-on-surface font-semibold">Igreja Batista Nacional da Paz de Guapó</strong> (CNPJ 02.930.019/0001-62).
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna de Mapa e Orientações -->
            <div class="lg:col-span-7 space-y-8">
                <div class="bg-surface-pure rounded-3xl border border-outline-variant/30 p-8 elevation-warm-1">
                    <h3 class="text-2xl font-extrabold text-on-surface mb-2">Localização no Mapa</h3>
                    <p class="text-sm text-text-muted mb-6">
                        Estamos localizados no Centro de Guapó-GO, com fácil acesso pela Avenida Principal da cidade e estacionamento no entorno.
                    </p>
                    @include('components.google-map', [
                        'mapId' => 'contato-map',
                        'heightClass' => 'aspect-[4/3] w-full',
                        'title' => 'Templo Sede - IBN da Paz de Guapó'
                    ])
                </div>

                <!-- Resumo de Cultos para Visitantes -->
                <div class="p-8 rounded-3xl bg-surface-cream-warm/30 border border-outline-variant/40 elevation-warm-1">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary">Horários das Reuniões</span>
                    <h4 class="text-xl font-extrabold text-on-surface mt-1 mb-4">Esperamos por Você!</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-surface-pure rounded-xl border border-outline-variant/30">
                            <span class="text-primary font-bold uppercase text-xs mb-1 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">alarm</span>
                                Quartas-feiras
                            </span>
                            <span class="text-xs font-semibold text-on-surface">19:30 às 21:00 • Oração e Estudo</span>
                        </div>
                        <div class="p-4 bg-surface-pure rounded-xl border border-outline-variant/30">
                            <span class="text-primary font-bold uppercase text-xs mb-1 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">alarm</span>
                                Domingos
                            </span>
                            <span class="text-xs font-semibold text-on-surface">19:30 às 21:00 • Culto de Celebração</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
