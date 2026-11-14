@extends('layouts.app')

@section('title', 'Blog da IBNP: direitos, serviços e vida em Guapó-GO')
@section('meta_description', 'Guias práticos e em linguagem simples sobre Cadastro Único, Bolsa Família, benefícios sociais e serviços públicos em Guapó-GO. Blog da IBNP.')

@section('content')
    <section class="relative overflow-hidden py-12 md:py-20 bg-gradient-to-b from-surface-cream-light via-[#FFFDF9] to-surface-cream-light border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl flex flex-col items-start gap-4">
                <div class="inline-flex items-center gap-2 bg-surface-cream-warm/60 border border-outline-variant/60 px-3.5 py-1.5 rounded-full">
                    <span class="material-symbols-outlined text-secondary text-[18px]" aria-hidden="true">menu_book</span>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary">Blog da IBNP</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-on-surface leading-[1.15] tracking-tight">
                    Informação que <span class="text-primary">cuida</span> das famílias de Guapó
                </h1>
                <p class="text-base sm:text-lg text-text-muted leading-relaxed">
                    Guias práticos, em linguagem simples, sobre direitos, benefícios e serviços públicos da nossa cidade. A IBNP não é órgão do governo: reunimos as informações para que cada família saiba onde buscar ajuda.
                </p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 md:py-20">
        @if (count($posts) === 0)
            <p class="text-text-muted">Em breve, novos conteúdos por aqui.</p>
        @else
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" aria-label="Posts do blog">
                @foreach ($posts as $post)
                    <li>
                        <article class="h-full flex flex-col bg-surface-pure border border-outline-variant/30 rounded-3xl p-6 sm:p-8 elevation-warm-1">
                            <span class="text-xs font-bold uppercase tracking-widest text-secondary">{{ $post->categoria }}</span>
                            <h2 class="mt-3 text-xl font-extrabold text-on-surface leading-snug tracking-tight">
                                <a href="{{ $post->url() }}" class="hover:text-primary transition-colors">{{ $post->titulo }}</a>
                            </h2>
                            <p class="mt-3 text-sm text-text-muted leading-relaxed flex-grow">{{ $post->resumo }}</p>
                            <div class="mt-5 flex items-center justify-between gap-3 text-xs text-text-muted">
                                <time datetime="{{ $post->data->format('Y-m-d') }}">{{ \App\DTO\BlogPostDto::dataPorExtenso($post->data) }}</time>
                                <span>{{ $post->minutosLeitura }} min de leitura</span>
                            </div>
                            <a href="{{ $post->url() }}" class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-primary hover:underline" aria-label="Ler: {{ $post->titulo }}">
                                <span>Ler o guia</span>
                                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_forward</span>
                            </a>
                        </article>
                    </li>
                @endforeach
            </ul>
        @endif

        <section aria-labelledby="titulo-ajuda-blog" class="mt-14 grid grid-cols-1 lg:grid-cols-12 gap-6 items-center bg-surface-pure border border-outline-variant/30 rounded-3xl p-6 sm:p-10 elevation-warm-1">
            <div class="lg:col-span-8 space-y-2">
                <h2 id="titulo-ajuda-blog" class="text-2xl font-extrabold text-on-surface tracking-tight">Chegou agora em Guapó?</h2>
                <p class="text-sm text-text-muted leading-relaxed">Veja o nosso Guia de Chegada, com documentos, saúde, escola, trabalho e transporte. E se precisar de orientação, fale com a gente.</p>
            </div>
            <div class="lg:col-span-4 flex flex-col gap-3">
                <a href="/guia-de-chegada" class="flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-primary text-on-primary text-sm font-bold shadow-sm hover:bg-secondary-container transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">waving_hand</span>
                    <span>Guia de Chegada</span>
                </a>
            </div>
        </section>
    </div>
@endsection
