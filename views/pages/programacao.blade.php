@extends('layouts.app')

@section('title', 'Programação e Encontros Comunitários - IBN da Paz de Guapó')
@section('meta_description', 'Horários dos encontros comunitários regulares e atividades formativas da IBN da Paz de Guapó-GO. Quartas e Domingos às 19:30.')

@section('head')
    @if (!empty($schemaJson))
        <script type="application/ld+json">
{!! $schemaJson !!}
        </script>
    @endif
@endsection

@section('content')
    <!-- Header Hero Programação (Stitch Warm Fellowship) -->
    <section class="relative overflow-hidden py-12 md:py-16 bg-gradient-to-b from-surface-cream-light via-[#FFFDF9] to-surface-cream-light border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl flex flex-col items-start gap-4">
                <div class="inline-flex items-center gap-2 bg-surface-cream-warm/40 border border-outline-variant/60 px-3.5 py-1.5 rounded-full text-on-surface">
                    <span class="material-symbols-outlined text-secondary text-[16px]">calendar_month</span>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary">Grade Semanal Oficial</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-on-surface leading-[1.15] tracking-tight">
                    Encontros Comunitários & Programação Aberta
                </h1>
                <p class="text-base sm:text-lg text-text-muted leading-relaxed">
                    Nossos encontros comunitários presenciais acontecem semanalmente às quartas e domingos na Sede Institucional em Guapó-GO. Você e sua família são nossos convidados de honra!
                </p>
            </div>
        </div>
    </section>

    <!-- Lista de Encontros Regulares -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
            @foreach ($agenda->cultosRegulares as $culto)
                @php
                    $diaUpper = mb_strtoupper($culto->diaSemana);
                    $horarioFim = $culto->getHorarioFim();
                    $gCalUrl = $googleCalendarUrls[$culto->id] ?? '#';
                @endphp
                <div class="bg-surface-pure rounded-3xl border border-outline-variant/30 p-8 elevation-warm-1 hover:border-secondary transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <!-- Header do Card -->
                        <div class="flex items-center justify-between gap-2 mb-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-surface-cream-warm/50 text-secondary border border-outline-variant/50">
                                <span class="material-symbols-outlined text-[14px]">event</span>
                                <span>{{ $diaUpper }}</span>
                            </span>
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-text-muted bg-surface-cream-light border border-outline-variant/40 px-2.5 py-1 rounded-full">
                                <span class="material-symbols-outlined text-[14px]">timer</span>
                                <span>{{ $culto->duracaoMinutos }} min</span>
                            </span>
                        </div>

                        <!-- Título e Categoria -->
                        <h2 class="text-2xl font-extrabold text-on-surface tracking-tight mb-1">
                            {{ $culto->nome }}
                        </h2>
                        <p class="text-xs font-bold uppercase tracking-widest text-secondary mb-4">
                            {{ $culto->categoria }}
                        </p>

                        <!-- Box de Horário -->
                        <div class="flex items-center gap-2.5 text-on-surface text-sm font-bold mb-4 bg-surface-cream-warm/20 p-3.5 rounded-xl border border-outline-variant/30">
                            <span class="material-symbols-outlined text-primary text-[20px]">alarm</span>
                            <span>{{ $culto->horario }} às {{ $horarioFim }} (Horário de Brasília)</span>
                        </div>

                        <!-- Descrição -->
                        <p class="text-text-muted text-sm leading-relaxed mb-6">
                            {{ $culto->descricao }}
                        </p>

                        <!-- Localização -->
                        <div class="text-xs text-text-muted mb-6 flex items-start gap-2">
                            <span class="material-symbols-outlined text-secondary text-[18px] flex-shrink-0">location_on</span>
                            <span>{{ $culto->local }}</span>
                        </div>
                    </div>

                    <!-- Ações: Google Agenda e iCal -->
                    <div class="pt-4 border-t border-outline-variant/30 flex items-center gap-3 flex-wrap">
                        <a href="{{ $gCalUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-on-primary text-xs font-bold shadow-md hover:bg-secondary-container transition-all active:scale-95">
                            <span class="material-symbols-outlined text-[16px]">calendar_add_on</span>
                            <span>Adicionar ao Google Agenda</span>
                        </a>
                        <a href="/programacao/ical" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-surface-pure border border-secondary text-secondary text-xs font-bold hover:bg-secondary-container/10 transition-all active:scale-95">
                            <span class="material-symbols-outlined text-[16px]">download</span>
                            <span>Baixar .ics</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Faixa Informativa Inferior -->
        <div class="mt-12 p-6 sm:p-8 rounded-2xl bg-surface-cream-warm/30 border border-outline-variant/40 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-surface-pure text-primary flex items-center justify-center shadow-xs">
                    <span class="material-symbols-outlined text-[24px]">info</span>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-on-surface">Encontros 100% Presenciais</h3>
                    <p class="text-xs text-text-muted">Todos os encontros são realizados presencialmente na Sede Institucional. Não realizamos transmissões simultâneas.</p>
                </div>
            </div>
            <a href="/contato" class="inline-flex items-center gap-1.5 text-xs font-bold text-secondary hover:text-primary transition-colors flex-shrink-0">
                <span>Ver Mapa e Como Chegar</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
    </main>
@endsection
