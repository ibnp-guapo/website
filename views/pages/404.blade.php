@extends('layouts.app')

@section('title', 'Página Não Encontrada (404) - IBNP')

@section('content')
    <main class="flex-1 max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 flex items-center justify-center">
        <div class="bg-surface-pure rounded-3xl p-8 sm:p-12 border border-outline-variant/30 elevation-warm-1 text-center w-full">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-surface-cream-warm/50 text-primary flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-[36px]">travel_explore</span>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-surface-cream-warm/40 border border-outline-variant/60 text-secondary text-xs font-bold uppercase tracking-wider">
                <span class="material-symbols-outlined text-[14px]">error_outline</span>
                <span>Erro 404</span>
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-on-surface mt-4 mb-4 tracking-tight">
                Página Não Encontrada
            </h1>
            <p class="text-text-muted text-sm sm:text-base max-w-md mx-auto mb-8 leading-relaxed">
                O endereço que você tentou acessar não existe ou foi remanejado. Utilize os botões abaixo para retornar à navegação.
            </p>
            <div class="flex items-center justify-center gap-4 flex-wrap">
                <a href="/" class="inline-flex items-center justify-center gap-2 bg-primary text-on-primary text-xs sm:text-sm font-bold px-6 py-3.5 rounded-xl shadow-md hover:bg-secondary-container transition-all duration-200 active:scale-95">
                    <span class="material-symbols-outlined text-[18px]">home</span>
                    <span>Voltar para o Início</span>
                </a>
                <a href="/programacao" class="inline-flex items-center justify-center gap-2 bg-surface-pure border border-secondary text-secondary text-xs sm:text-sm font-bold px-6 py-3.5 rounded-xl hover:bg-secondary-container/10 transition-all duration-200 active:scale-95">
                    <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                    <span>Ver Programação</span>
                </a>
            </div>
        </div>
    </main>
@endsection
