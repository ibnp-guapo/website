@extends('layouts.app')

@section('title', $post->titulo . ' | Blog da IBNP')
@section('meta_description', $post->resumo)
@section('og_type', 'article')

@php
    $wa = 'https://wa.me/5562998700089?text=' . rawurlencode('Olá! Li o guia "' . $post->titulo . '" no site da IBNP e gostaria de uma orientação.');
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $post->titulo,
        'description' => $post->resumo,
        'datePublished' => $post->data->format('Y-m-d'),
        'dateModified' => ($post->atualizado ?? $post->data)->format('Y-m-d'),
        'inLanguage' => 'pt-BR',
        'mainEntityOfPage' => 'https://ibnpguapo.org.br' . $post->url(),
        'keywords' => implode(', ', $post->tags),
        'author' => ['@type' => 'Organization', 'name' => 'Igreja Batista Nacional da Paz de Guapó', 'url' => 'https://ibnpguapo.org.br'],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Igreja Batista Nacional da Paz de Guapó',
            'logo' => ['@type' => 'ImageObject', 'url' => 'https://ibnpguapo.org.br/assets/images/logo-ibnp.png'],
        ],
    ];
@endphp

@section('head')
    <meta property="article:published_time" content="{{ $post->data->format('Y-m-d') }}">
    <meta property="article:modified_time" content="{{ ($post->atualizado ?? $post->data)->format('Y-m-d') }}">
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
@endsection

@section('content')
    <article>
        <header class="relative overflow-hidden py-12 md:py-16 bg-gradient-to-b from-surface-cream-light via-[#FFFDF9] to-surface-cream-light border-b border-outline-variant/30">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-start gap-4">
                <nav aria-label="Trilha de navegação" class="text-xs font-semibold text-text-muted">
                    <a href="/blog" class="inline-flex items-center gap-1 hover:text-primary">
                        <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_back</span>
                        <span>Blog da IBNP</span>
                    </a>
                </nav>
                <span class="text-xs font-bold uppercase tracking-widest text-secondary">{{ $post->categoria }}</span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-on-surface leading-[1.2] tracking-tight">{{ $post->titulo }}</h1>
                <p class="text-base sm:text-lg text-text-muted leading-relaxed">{{ $post->resumo }}</p>
                <p class="text-xs text-text-muted flex flex-wrap gap-x-4 gap-y-1">
                    <span>Publicado em <time datetime="{{ $post->data->format('Y-m-d') }}">{{ \App\DTO\BlogPostDto::dataPorExtenso($post->data) }}</time></span>
                    @if ($post->atualizado && $post->atualizado > $post->data)
                        <span>Atualizado em <time datetime="{{ $post->atualizado->format('Y-m-d') }}">{{ \App\DTO\BlogPostDto::dataPorExtenso($post->atualizado) }}</time></span>
                    @endif
                    <span>{{ $post->minutosLeitura }} min de leitura</span>
                    @if ($post->serie)
                        <span>Série: {{ $post->serie }}</span>
                    @endif
                </p>
            </div>
        </header>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="artigo">
                {!! $post->html !!}
            </div>

            <aside aria-labelledby="titulo-ajuda-post" class="mt-12 bg-surface-pure border border-outline-variant/30 rounded-3xl p-6 sm:p-8 elevation-warm-1 space-y-4">
                <h2 id="titulo-ajuda-post" class="text-xl font-extrabold text-on-surface tracking-tight">Ficou com dúvida?</h2>
                <p class="text-sm text-text-muted leading-relaxed">A IBNP não é órgão do governo, mas pode ajudar você a se orientar. Fale com a gente ou venha nos visitar: encontros aos domingos, às 9h e às 19h30.</p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ $wa }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-[#25D366] text-white text-sm font-bold shadow-sm hover:opacity-95 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">chat</span>
                        <span>Falar com a IBNP no WhatsApp</span>
                    </a>
                    <a href="/programacao" class="flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-primary text-on-primary text-sm font-bold shadow-sm hover:bg-secondary-container transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">calendar_month</span>
                        <span>Planeje sua Visita</span>
                    </a>
                </div>
            </aside>
        </div>
    </article>

    @if (count($relacionados) > 0)
        <section aria-labelledby="titulo-relacionados" class="border-t border-outline-variant/30 bg-surface-cream-light">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
                <h2 id="titulo-relacionados" class="text-2xl font-extrabold text-on-surface tracking-tight mb-6">Leia também</h2>
                <ul class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($relacionados as $outro)
                        <li class="bg-surface-pure border border-outline-variant/30 rounded-3xl p-6 elevation-warm-1">
                            <span class="text-xs font-bold uppercase tracking-widest text-secondary">{{ $outro->categoria }}</span>
                            <h3 class="mt-2 text-lg font-extrabold text-on-surface leading-snug">
                                <a href="{{ $outro->url() }}" class="hover:text-primary transition-colors">{{ $outro->titulo }}</a>
                            </h3>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif
@endsection
