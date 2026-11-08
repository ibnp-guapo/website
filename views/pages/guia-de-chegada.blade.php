@extends('layouts.app')

@section('title', 'Mudou para Guapó-GO? Guia para novos moradores | IBNP')
@section('meta_description', 'Chegou em Guapó-GO? Veja como regularizar documentos, Cartão SUS, escola das crianças, Cadastro Único, trabalho e título de eleitor. Guia gratuito da IBNP.')
@section('og_image', '/assets/images/og-guia-de-chegada.jpg')
@section('og_image_alt', 'Guia de Chegada da IBNP: Chegou agora em Guapó?')

@php
    $wa = 'https://wa.me/5562998700089?text=' . rawurlencode('Olá! Cheguei agora em Guapó e gostaria de uma orientação da IBNP.');

    $passos = [
        'Separe seus documentos e os de toda a família (RG ou Carteira de Identidade, CPF, certidões de nascimento ou casamento).',
        'Consiga um comprovante de endereço em Guapó: conta de luz ou água, contrato de aluguel ou declaração do dono do imóvel.',
        'Atualize seu endereço no Cartão SUS na unidade de saúde do seu bairro.',
        'Matricule as crianças na escola, levando a declaração de transferência da escola antiga.',
        'Se você recebe Bolsa Família ou outro benefício, atualize o Cadastro Único no CRAS de Guapó.',
        'Depois de 3 meses morando aqui, transfira seu título de eleitor.',
    ];

    $temas = [
        [
            'id' => 'documentos', 'icone' => 'badge', 'titulo' => 'Documentos',
            'texto' => 'Quase tudo começa pelos documentos. Guarde cópias e fotos de todos, de cada pessoa da família.',
            'itens' => [
                '<strong>CPF:</strong> é o número que identifica você em todos os serviços. Pode ser consultado e regularizado pela internet.',
                '<strong>Carteira de Identidade Nacional (CIN):</strong> usa o número do CPF e é gratuita na primeira via. Em Goiás, o atendimento é feito com agendamento no Vapt Vupt.',
                '<strong>Comprovante de endereço:</strong> se a conta ainda não está no seu nome, peça ao dono do imóvel uma declaração de residência com cópia do documento dele.',
            ],
            'links' => [
                ['Consultar CPF (Receita Federal)', 'https://www.gov.br/receitafederal/pt-br/assuntos/meu-cpf'],
                ['Agendar no Vapt Vupt', 'https://www.vaptvupt.go.gov.br/'],
            ],
        ],
        [
            'id' => 'saude', 'icone' => 'medical_services', 'titulo' => 'Saúde',
            'texto' => 'O SUS atende em qualquer cidade do Brasil, mas o acompanhamento da família é feito pela unidade de saúde do seu bairro.',
            'itens' => [
                'Leve <strong>documento com foto, CPF, Cartão SUS e comprovante de endereço</strong> à Unidade Básica de Saúde (UBS) mais próxima e peça para atualizar o cadastro.',
                'Leve também a <strong>caderneta de vacinação</strong> das crianças e de quem estiver grávida.',
                'Quem usa remédio contínuo deve levar a última receita, para continuar o tratamento sem interrupção.',
                'No aplicativo <strong>Meu SUS Digital</strong> você vê seu cartão, suas vacinas e seus atendimentos.',
            ],
            'links' => [
                ['Meu SUS Digital', 'https://meususdigital.saude.gov.br/'],
            ],
        ],
        [
            'id' => 'escola', 'icone' => 'school', 'titulo' => 'Escola das crianças',
            'texto' => 'Toda criança e adolescente tem direito à vaga na escola pública, inclusive no meio do ano.',
            'itens' => [
                '<strong>Educação infantil e anos iniciais</strong> (1º ao 5º ano): procure a Secretaria Municipal de Educação de Guapó ou a escola municipal do seu bairro.',
                '<strong>Anos finais e ensino médio</strong> (6º ano em diante): escolas da rede estadual de Goiás.',
                'Leve <strong>certidão de nascimento, CPF, caderneta de vacinação, comprovante de endereço</strong> e a <strong>declaração de transferência</strong> ou o histórico da escola anterior.',
                'Se ainda não tiver a transferência, matricule assim mesmo e peça o documento à escola antiga depois.',
            ],
            'links' => [],
        ],
        [
            'id' => 'assistencia', 'icone' => 'family_restroom', 'titulo' => 'Cadastro Único e benefícios',
            'texto' => 'Quem muda de cidade precisa atualizar o Cadastro Único. Sem isso, o Bolsa Família e outros benefícios podem ser bloqueados.',
            'itens' => [
                'Vá ao <strong>CRAS</strong> (Centro de Referência de Assistência Social) de Guapó com os documentos de todos da casa e o comprovante de endereço.',
                'O Cadastro Único também dá acesso à tarifa social de energia, a programas de moradia e a outros apoios.',
                'Dúvidas sobre o Bolsa Família podem ser tiradas de graça no <strong>Disque Social 121</strong>.',
            ],
            'links' => [
                ['Cadastro Único (MDS)', 'https://www.gov.br/mds/pt-br/acoes-e-programas/cadastro-unico'],
            ],
        ],
        [
            'id' => 'trabalho', 'icone' => 'work', 'titulo' => 'Trabalho',
            'texto' => 'Guapó fica a cerca de 35 km de Goiânia, e muita gente trabalha na região metropolitana.',
            'itens' => [
                'Baixe a <strong>Carteira de Trabalho Digital</strong>: ela já vem pronta com o seu CPF.',
                'Vagas de emprego e seguro-desemprego são atendidos pelo <strong>Sine</strong>, presente nas unidades do Vapt Vupt.',
                'Mantenha um currículo simples no celular, com telefone e WhatsApp atualizados.',
            ],
            'links' => [
                ['Carteira de Trabalho Digital', 'https://www.gov.br/trabalho-e-emprego/pt-br/servicos/trabalhador/carteira-de-trabalho'],
            ],
        ],
        [
            'id' => 'titulo', 'icone' => 'how_to_vote', 'titulo' => 'Título de eleitor',
            'texto' => 'Para votar em Guapó, transfira o título depois de pelo menos 3 meses morando na cidade.',
            'itens' => [
                'A transferência pode ser pedida pela internet, no Autoatendimento Eleitoral do TSE.',
                'É preciso ter passado pelo menos 1 ano desde que você tirou o título ou fez a última transferência.',
                'Se houver multa por falta às urnas, ela precisa ser paga antes do pedido. Em ano de eleição, o prazo fecha meses antes do pleito.',
            ],
            'links' => [
                ['Como transferir o título (TSE)', 'https://www.tse.jus.br/comunicacao/noticias/2026/Janeiro/eleitor-em-dia-mudou-de-municipio-veja-como-transferir-o-titulo-de-eleitor'],
            ],
        ],
        [
            'id' => 'moradia', 'icone' => 'home', 'titulo' => 'Moradia',
            'texto' => 'Na pressa de se instalar, muita gente cai em golpe de aluguel. Alguns cuidados ajudam:',
            'itens' => [
                '<strong>Visite o imóvel antes de pagar qualquer valor.</strong> Desconfie de quem pede depósito só por foto.',
                'Faça um <strong>contrato por escrito</strong>, com valor, prazo e quem paga água e luz, e peça recibo de cada pagamento.',
                'O contrato de aluguel também serve como comprovante de endereço para escola, saúde e CRAS.',
            ],
            'links' => [],
        ],
    ];

    $telefones = [
        ['190', 'Polícia Militar'],
        ['192', 'SAMU'],
        ['193', 'Bombeiros'],
        ['121', 'Disque Social (Bolsa Família)'],
        ['136', 'Disque Saúde'],
        ['180', 'Central de Atendimento à Mulher'],
        ['100', 'Disque Direitos Humanos'],
    ];
@endphp

@section('head')
    @php
        $base = 'https://ibnpguapo.org.br';
        $schema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebPage',
                    '@id' => $base . '/guia-de-chegada#pagina',
                    'url' => $base . '/guia-de-chegada',
                    'name' => 'Guia de Chegada para novos moradores de Guapó-GO',
                    'description' => 'Orientações para quem acabou de se mudar para Guapó-GO: documentos, saúde, escola, Cadastro Único, trabalho, título de eleitor e moradia.',
                    'inLanguage' => 'pt-BR',
                    'primaryImageOfPage' => $base . '/assets/images/og-guia-de-chegada.jpg',
                    'about' => ['@type' => 'City', 'name' => 'Guapó', 'containedInPlace' => ['@type' => 'State', 'name' => 'Goiás']],
                    'audience' => ['@type' => 'Audience', 'audienceType' => 'Novos moradores e famílias migrantes em Guapó-GO'],
                    'breadcrumb' => ['@id' => $base . '/guia-de-chegada#breadcrumb'],
                    'mainEntity' => ['@id' => $base . '/guia-de-chegada#passos'],
                    'publisher' => ['@id' => $base . '/#igreja'],
                ],
                [
                    '@type' => 'BreadcrumbList',
                    '@id' => $base . '/guia-de-chegada#breadcrumb',
                    'itemListElement' => [
                        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Início', 'item' => $base . '/'],
                        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Guia de Chegada', 'item' => $base . '/guia-de-chegada'],
                    ],
                ],
                [
                    '@type' => 'HowTo',
                    '@id' => $base . '/guia-de-chegada#passos',
                    'name' => 'Primeiros passos para quem chegou em Guapó-GO',
                    'step' => array_map(
                        fn ($texto, $i) => ['@type' => 'HowToStep', 'position' => $i + 1, 'text' => $texto],
                        $passos,
                        array_keys($passos)
                    ),
                ],
                [
                    '@type' => 'Church',
                    '@id' => $base . '/#igreja',
                    'name' => 'Igreja Batista Nacional da Paz de Guapó (IBNP)',
                    'url' => $base . '/',
                    'logo' => $base . '/assets/images/logo-ibnp.png',
                    'telephone' => '+55-62-99870-0089',
                    'email' => 'contato@ibnpguapo.org.br',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro',
                        'addressLocality' => 'Guapó',
                        'addressRegion' => 'GO',
                        'postalCode' => '75350-000',
                        'addressCountry' => 'BR',
                    ],
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_HEX_TAG) !!}
    </script>
@endsection

@section('content')
    <!-- Hero: boas-vindas a quem chega -->
    <section class="relative overflow-hidden py-12 md:py-20 bg-gradient-to-b from-surface-cream-light via-[#FFFDF9] to-surface-cream-light border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl flex flex-col items-start gap-4">
                <div class="inline-flex items-center gap-2 bg-surface-cream-warm/60 border border-outline-variant/60 px-3.5 py-1.5 rounded-full">
                    <span class="material-symbols-outlined text-secondary text-[18px]">waving_hand</span>
                    <span class="text-xs font-bold uppercase tracking-wider text-secondary">Guia de Chegada</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-on-surface leading-[1.15] tracking-tight">
                    Chegou agora em <span class="text-primary">Guapó</span>? Seja bem-vindo!
                </h1>
                <p class="text-base sm:text-lg text-text-muted leading-relaxed">
                    Muitas famílias que fazem parte da IBNP vieram de outras regiões do Brasil, principalmente do Norte, em busca de uma vida melhor. Sabemos como é chegar a uma cidade nova sem conhecer ninguém. Reunimos aqui o que você precisa resolver nas primeiras semanas, e estamos aqui para ajudar no que for preciso.
                </p>
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <a href="{{ $wa }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#25D366] text-white text-xs font-bold shadow-sm hover:opacity-95 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">chat</span>
                        <span>Falar com a IBNP no WhatsApp</span>
                    </a>
                    <a href="#primeiros-passos" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-primary text-on-primary text-xs font-bold shadow-sm hover:bg-secondary-container transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">checklist</span>
                        <span>Ver os primeiros passos</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 md:py-20 space-y-14">

        <!-- Primeiros passos -->
        <section id="primeiros-passos" aria-labelledby="titulo-passos" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-4 space-y-3">
                <span class="text-xs font-bold uppercase tracking-widest text-secondary block">Por onde começar</span>
                <h2 id="titulo-passos" class="text-2xl sm:text-4xl font-extrabold text-on-surface tracking-tight">Primeiros passos</h2>
                <p class="text-sm text-text-muted leading-relaxed">Siga esta ordem. Cada etapa facilita a próxima, porque quase todos os serviços pedem documento e comprovante de endereço.</p>
                <nav aria-label="Temas do guia" class="flex flex-wrap gap-2 pt-2">
                    @foreach ($temas as $tema)
                        <a href="#{{ $tema['id'] }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-surface-cream-warm/60 text-secondary text-xs font-bold hover:bg-surface-cream-warm transition-colors">
                            <span class="material-symbols-outlined text-[15px]">{{ $tema['icone'] }}</span>
                            <span>{{ $tema['titulo'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
            <ol class="lg:col-span-8 space-y-3">
                @foreach ($passos as $i => $passo)
                    <li class="flex items-start gap-4 p-4 sm:p-5 rounded-2xl bg-surface-pure border border-outline-variant/30">
                        <span class="w-8 h-8 shrink-0 rounded-full bg-primary text-on-primary text-sm font-extrabold flex items-center justify-center" aria-hidden="true">{{ $i + 1 }}</span>
                        <span class="text-sm text-on-surface leading-relaxed pt-1">{{ $passo }}</span>
                    </li>
                @endforeach
            </ol>
        </section>

        <!-- Temas -->
        <section aria-labelledby="titulo-temas" class="space-y-6">
            <div class="text-center max-w-3xl mx-auto">
                <span class="text-xs font-bold uppercase tracking-widest text-secondary block mb-2">Passo a passo</span>
                <h2 id="titulo-temas" class="text-2xl sm:text-4xl font-extrabold text-on-surface">O que resolver em Guapó</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($temas as $tema)
                    <article id="{{ $tema['id'] }}" class="scroll-mt-28 bg-surface-pure rounded-3xl border border-outline-variant/30 p-6 sm:p-8 elevation-warm-1 flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 shrink-0 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center">
                                <span class="material-symbols-outlined text-[24px]">{{ $tema['icone'] }}</span>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-on-surface tracking-tight">{{ $tema['titulo'] }}</h3>
                        </div>
                        <p class="text-sm text-text-muted leading-relaxed">{{ $tema['texto'] }}</p>
                        <ul class="space-y-2.5">
                            @foreach ($tema['itens'] as $item)
                                <li class="flex items-start gap-2.5 text-sm text-on-surface leading-relaxed">
                                    <span class="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5" aria-hidden="true">check_circle</span>
                                    <span>{!! $item !!}</span>
                                </li>
                            @endforeach
                        </ul>
                        @if (count($tema['links']) > 0)
                            <div class="flex flex-wrap gap-2 pt-2 mt-auto border-t border-outline-variant/30">
                                @foreach ($tema['links'] as [$rotulo, $url])
                                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 mt-3 px-3.5 py-2 rounded-xl bg-surface-cream-light border border-outline-variant/40 text-xs font-bold text-primary hover:bg-surface-cream-warm/50 transition-colors" title="{{ $rotulo }} (abre em nova aba)">
                                        <span>{{ $rotulo }}</span>
                                        <span class="material-symbols-outlined text-[14px]" aria-hidden="true">open_in_new</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
            <p class="text-xs text-text-muted text-center max-w-2xl mx-auto leading-relaxed">
                Endereços e horários dos órgãos públicos de Guapó mudam com frequência. Confirme na Prefeitura de Guapó antes de ir, ou pergunte para a gente no WhatsApp.
            </p>
        </section>

        <!-- Telefones úteis -->
        <section aria-labelledby="titulo-telefones" class="bg-surface-cream-warm/40 border border-outline-variant/40 rounded-3xl p-6 sm:p-10">
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-primary text-[26px]" aria-hidden="true">call</span>
                <h2 id="titulo-telefones" class="text-xl sm:text-2xl font-extrabold text-on-surface">Telefones úteis (ligação gratuita)</h2>
            </div>
            <ul class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach ($telefones as [$numero, $servico])
                    <li>
                        <a href="tel:{{ $numero }}" class="flex flex-col gap-0.5 p-4 rounded-2xl bg-surface-pure border border-outline-variant/30 hover:border-primary/40 transition-colors h-full">
                            <span class="text-2xl font-extrabold text-primary">{{ $numero }}</span>
                            <span class="text-xs font-semibold text-on-surface">{{ $servico }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>

        <!-- Como a IBNP pode ajudar -->
        <section aria-labelledby="titulo-ajuda" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-surface-pure border border-outline-variant/30 rounded-3xl p-6 sm:p-12 elevation-warm-1">
            <div class="lg:col-span-7 space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-secondary block">Você não está sozinho</span>
                <h2 id="titulo-ajuda" class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">Como a IBNP pode ajudar</h2>
                <p class="text-sm text-text-muted leading-relaxed">
                    Muitos de nós também chegamos a Guapó vindos de longe. Se você não sabe onde fica um serviço, que documento levar ou só precisa de alguém para conversar e orar com você, fale com a gente.
                </p>
                <ul class="space-y-2.5">
                    <li class="flex items-start gap-2.5 text-sm text-on-surface"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5" aria-hidden="true">favorite</span><span><strong>Acolhimento:</strong> uma conversa sem pressa com a liderança, e a gente apresenta você à comunidade.</span></li>
                    <li class="flex items-start gap-2.5 text-sm text-on-surface"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5" aria-hidden="true">explore</span><span><strong>Orientação:</strong> ajudamos a encontrar o CRAS, a unidade de saúde e a escola mais perto de você.</span></li>
                    <li class="flex items-start gap-2.5 text-sm text-on-surface"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5" aria-hidden="true">diversity_3</span><span><strong>Comunidade:</strong> encontros às quartas e domingos, às 19:30, e atividades para as crianças.</span></li>
                </ul>
            </div>
            <div class="lg:col-span-5 flex flex-col gap-3">
                <a href="{{ $wa }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-[#25D366] text-white text-sm font-bold shadow-sm hover:opacity-95 transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[20px]">chat</span>
                    <span>Falar com a IBNP no WhatsApp</span>
                </a>
                <a href="/programacao" class="flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-primary text-on-primary text-sm font-bold shadow-sm hover:bg-secondary-container transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                    <span>Planeje sua Visita</span>
                </a>
                <a href="/contato" class="flex items-center justify-center gap-2 px-6 py-4 rounded-xl border border-outline-variant/60 text-on-surface text-sm font-bold hover:bg-surface-cream-warm/50 transition-all">
                    <span class="material-symbols-outlined text-[20px]">location_on</span>
                    <span>Como chegar à igreja</span>
                </a>
            </div>
        </section>
    </div>
@endsection
