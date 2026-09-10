@extends('layouts.app')

@section('title', 'Página Não Encontrada (404) - IBN da Paz de Guapó')

@section('content')
    <main class="flex-1 max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-20 flex items-center justify-center">
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-xs text-center w-full">
            <span class="text-4xl block mb-4">🕊️</span>
            <span class="text-xs font-bold uppercase tracking-widest text-ibnp-primary bg-orange-50 px-3 py-1 rounded-full border border-orange-200">
                Erro 404
            </span>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 mt-4 mb-4 tracking-tight">
                Página Não Encontrada
            </h1>
            <p class="text-slate-600 text-sm sm:text-base max-w-md mx-auto mb-8 leading-relaxed">
                O endereço que você tentou acessar não existe ou foi remanejado. Utilize os botões abaixo para retornar à navegação.
            </p>
            <div class="flex items-center justify-center gap-4 flex-wrap">
                <a href="/" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-ibnp-primary text-white text-xs font-bold hover:bg-orange-700 transition shadow-sm">
                    <span>Voltar para o Início</span>
                </a>
                <a href="/programacao" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold hover:bg-slate-200 transition">
                    <span>Ver Programação</span>
                </a>
            </div>
        </div>
    </main>
@endsection
