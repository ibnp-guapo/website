@extends('layouts.app')

@section('title', 'Inscrição para o Coral de Natal | Programa de Desenvolvimento Infantil - IBNP')
@section('meta_description', 'Oficina de canto coral infantil da IBNP em Guapó para apresentação especial de Natal no mês de dezembro. 30 vagas gratuitas para crianças de 5 a 12 anos.')

@section('content')
    <!-- Hero Section Coral de Natal -->
    <section class="relative overflow-hidden py-12 md:py-16 bg-gradient-to-b from-surface-cream-light via-[#FFFDF9] to-surface-cream-light border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <!-- Coluna de Texto e Apresentação -->
                <div class="lg:col-span-7 space-y-4">
                    <div class="inline-flex items-center gap-2 bg-surface-cream-warm/60 border border-outline-variant/60 px-3.5 py-1.5 rounded-full text-on-surface">
                        <span class="material-symbols-outlined text-secondary text-[18px]">music_note</span>
                        <span class="text-xs font-bold uppercase tracking-wider text-secondary">Programa de Desenvolvimento Infantil • Natal 2026</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-extrabold text-on-surface leading-[1.15] tracking-tight">
                        Coral de Natal Infantil em Guapó
                    </h1>

                    <p class="text-base sm:text-lg text-text-muted leading-relaxed">
                        Uma oportunidade especial de iniciação musical, expressão vocal e convivência comunitária para as crianças da nossa cidade. Ensaios preparatórios ao longo do mês de dezembro para a celebração de Natal da IBNP.
                    </p>

                    <!-- Contexto Cívico e Cultural de Guapó -->
                    <div class="p-4 rounded-2xl bg-surface-cream-warm/30 border border-outline-variant/40 text-xs sm:text-sm text-text-muted leading-relaxed space-y-2">
                        <div class="flex items-center gap-2 text-on-surface font-bold">
                            <span class="material-symbols-outlined text-secondary text-[18px]">school</span>
                            <span>Musicalização Integrada para a Infância de Guapó</span>
                        </div>
                        <p>
                            Enquanto a prefeitura da cidade incentiva e estimula as crianças a ingressarem em <strong>banda marcial</strong> para desenvolver suas habilidades rítmicas e instrumentais, a IBNP atua de forma complementar oferecendo <strong>ensaios de canto coral</strong>, estimulando a afinação, a sensibilidade poética e o desenvolvimento socioemocional dos pequenos.
                        </p>
                    </div>

                    <!-- Badges Rápidos -->
                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-secondary/10 text-secondary text-xs font-extrabold">
                            <span class="material-symbols-outlined text-[16px]">groups</span>
                            <span>30 vagas gratuitas</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-surface-cream-warm text-on-surface text-xs font-bold">
                            <span class="material-symbols-outlined text-[16px]">cake</span>
                            <span>Faixa etária: 5 a 12 anos</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-surface-cream-warm text-on-surface text-xs font-bold">
                            <span class="material-symbols-outlined text-[16px]">event</span>
                            <span>Mês de dezembro</span>
                        </span>
                    </div>
                </div>

                <!-- Coluna de Imagem / Fotografia Contextual Local (Pexels) -->
                <div class="lg:col-span-5">
                    <div class="relative rounded-3xl overflow-hidden shadow-md border border-outline-variant/40 bg-surface-pure">
                        <img 
                            src="/assets/images/coral-natal-criancas.jpg" 
                            alt="Crianças cantando e participando de oficina de música em coral infantil" 
                            width="800" 
                            height="533" 
                            class="w-full h-72 sm:h-80 object-cover"
                            loading="eager"
                            fetchpriority="high"
                        >
                        <div class="p-4 bg-surface-pure/95 border-t border-outline-variant/30 flex items-center justify-between text-xs text-text-muted">
                            <span class="flex items-center gap-1.5 font-semibold text-on-surface">
                                <span class="material-symbols-outlined text-secondary text-[16px]">volunteer_activism</span>
                                <span>Oficina 100% Gratuita da IBNP</span>
                            </span>
                            <span>Guapó - GO</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Inscrição e Formulário -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 space-y-12">
        <!-- Indicador de Status das Vagas -->
        <div class="p-6 rounded-3xl bg-surface-pure border border-outline-variant/30 elevation-warm-1 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl {{ ($statusVagas['esgotado'] ?? false) ? 'bg-error/10 text-error' : 'bg-secondary/10 text-secondary' }} flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[26px]">{{ ($statusVagas['esgotado'] ?? false) ? 'event_busy' : 'how_to_reg' }}</span>
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-text-muted block">Status das Inscrições</span>
                    <h2 class="text-lg font-extrabold text-on-surface">
                        @if($statusVagas['esgotado'] ?? false)
                            30 vagas preenchidas • Inscrições Esgotadas
                        @else
                            {{ $statusVagas['restantes'] ?? 30 }} de 30 vagas gratuitas disponíveis
                        @endif
                    </h2>
                </div>
            </div>
            
            <div class="text-xs text-text-muted text-center sm:text-right">
                <span class="block font-semibold text-on-surface">Encontros presenciais na sede da IBNP</span>
                <span>Rua Presidente Kennedy, Qd. 21, Lt. 13 • Centro, Guapó</span>
            </div>
        </div>

        @if(!empty($sucesso) && !empty($inscricao))
            <!-- Mensagem de Sucesso -->
            <div class="p-8 sm:p-10 rounded-3xl bg-surface-pure border-2 border-secondary/40 elevation-warm-1 space-y-6 animate-fade-in">
                <div class="flex items-center gap-3 text-secondary">
                    <div class="w-12 h-12 rounded-2xl bg-secondary/15 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[28px]">check_circle</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-on-surface">Inscrição Realizada com Sucesso!</h3>
                        <p class="text-xs font-bold uppercase tracking-wider text-secondary">Vaga {{ $inscricao['numero_vaga'] }} de 30 Confirmada</p>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-surface-cream-light border border-outline-variant/30 space-y-2 text-xs sm:text-sm">
                    <p><strong class="text-on-surface">Criança Inscrita:</strong> {{ $inscricao['nome_crianca'] }} ({{ $inscricao['idade_crianca'] }} anos)</p>
                    <p><strong class="text-on-surface">Responsável:</strong> {{ $inscricao['nome_responsavel'] }}</p>
                    <p><strong class="text-on-surface">WhatsApp:</strong> {{ $inscricao['telefone_responsavel'] }}</p>
                    <p><strong class="text-on-surface">Identificador da Inscrição:</strong> <span class="font-mono font-bold text-secondary">{{ $inscricao['id'] }}</span></p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4 pt-2">
                    @php
                        $msgWhatsapp = rawurlencode("Olá! Realizei a inscrição da criança {$inscricao['nome_crianca']} no Coral de Natal da IBNP (Vaga {$inscricao['numero_vaga']} de 30 - ID: {$inscricao['id']}). Gostaria de confirmar!");
                    @endphp
                    <a href="https://wa.me/5562998700089?text={{ $msgWhatsapp }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-3.5 rounded-xl bg-[#25D366] text-white text-xs font-bold shadow-sm hover:opacity-95 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">chat</span>
                        <span>Enviar Confirmação pelo WhatsApp</span>
                    </a>
                    <a href="/coral-natal" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-5 py-3.5 rounded-xl bg-surface-cream-warm text-on-surface text-xs font-bold hover:bg-surface-cream-warm/80 transition-all">
                        <span>Nova Consulta / Inscrição</span>
                    </a>
                </div>
            </div>
        @elseif($statusVagas['esgotado'] ?? false)
            <!-- Alerta de Vagas Esgotadas -->
            <div class="p-8 sm:p-10 rounded-3xl bg-surface-pure border border-outline-variant/40 elevation-warm-1 text-center space-y-4">
                <div class="w-16 h-16 rounded-full bg-surface-cream-warm text-secondary flex items-center justify-center mx-auto">
                    <span class="material-symbols-outlined text-[32px]">event_busy</span>
                </div>
                <h3 class="text-2xl font-extrabold text-on-surface">Todas as 30 Vagas Foram Preenchidas!</h3>
                <p class="text-sm text-text-muted max-w-xl mx-auto leading-relaxed">
                    Agradecemos o carinho e o interesse de todas as famílias de Guapó. Se você gostaria de incluir seu filho ou filha na <strong>lista de espera</strong> para casos de desistência, envie uma mensagem diretamente para nossa equipe de coordenação infantil no WhatsApp.
                </p>
                <div class="pt-2">
                    <a href="https://wa.me/5562998700089?text=Ol%C3%A1!%20Gostaria%20de%20entrar%20na%20lista%20de%20espera%20para%20o%20Coral%20de%20Natal%20da%20IBNP." target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-[#25D366] text-white text-xs font-bold shadow-sm hover:opacity-95 transition-all">
                        <span class="material-symbols-outlined text-[18px]">chat</span>
                        <span>Falar com a Coordenação no WhatsApp</span>
                    </a>
                </div>
            </div>
        @else
            <!-- Formulário de Inscrição Ativo -->
            <div class="bg-surface-pure rounded-3xl border border-outline-variant/30 p-8 sm:p-10 elevation-warm-1 space-y-8">
                <div>
                    <h2 class="text-2xl font-extrabold text-on-surface tracking-tight">Formulário de Inscrição</h2>
                    <p class="text-xs sm:text-sm text-text-muted mt-1 leading-relaxed">
                        Preencha os dados da criança e do responsável abaixo para garantir uma das 30 vagas gratuitas.
                    </p>
                </div>

                @if(!empty($erros))
                    <div class="p-4 rounded-2xl bg-error/10 border border-error/20 text-xs text-error space-y-1">
                        <p class="font-bold flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">error</span>
                            <span>Preencha corretamente os campos destacados:</span>
                        </p>
                        <ul class="list-disc list-inside space-y-0.5 pl-1">
                            @foreach($erros as $campo => $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/coral-natal/inscrever" method="POST" class="space-y-6">
                    <!-- Campo: Nome da Criança -->
                    <div class="space-y-1.5">
                        <label for="nome_crianca" class="block text-xs font-bold uppercase tracking-wider text-on-surface">
                            Nome Completo da Criança <span class="text-error">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nome_crianca" 
                            name="nome_crianca" 
                            value="{{ $old['nome_crianca'] ?? '' }}" 
                            required 
                            minlength="3" 
                            maxlength="100" 
                            placeholder="Ex: Gabriel Henrique Silva"
                            class="w-full px-4 py-3 rounded-xl border {{ isset($erros['nome_crianca']) ? 'border-error ring-1 ring-error' : 'border-outline-variant/40' }} bg-surface-cream-light text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-secondary transition-all"
                        >
                    </div>

                    <!-- Linha dupla: Idade da Criança e Telefone WhatsApp -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-6">
                        <!-- Idade da Criança -->
                        <div class="sm:col-span-4 space-y-1.5">
                            <label for="idade_crianca" class="block text-xs font-bold uppercase tracking-wider text-on-surface">
                                Idade (5 a 12 anos) <span class="text-error">*</span>
                            </label>
                            <select 
                                id="idade_crianca" 
                                name="idade_crianca" 
                                required
                                class="w-full px-4 py-3 rounded-xl border {{ isset($erros['idade_crianca']) ? 'border-error ring-1 ring-error' : 'border-outline-variant/40' }} bg-surface-cream-light text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-secondary transition-all"
                            >
                                <option value="">Selecione a idade</option>
                                @for($i = 5; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ (isset($old['idade_crianca']) && (int)$old['idade_crianca'] === $i) ? 'selected' : '' }}>
                                        {{ $i }} anos
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Telefone WhatsApp -->
                        <div class="sm:col-span-8 space-y-1.5">
                            <label for="telefone_responsavel" class="block text-xs font-bold uppercase tracking-wider text-on-surface">
                                WhatsApp do Responsável (com DDD) <span class="text-error">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="telefone_responsavel" 
                                name="telefone_responsavel" 
                                value="{{ $old['telefone_responsavel'] ?? '' }}" 
                                required 
                                placeholder="(62) 98765-4321"
                                class="w-full px-4 py-3 rounded-xl border {{ isset($erros['telefone_responsavel']) ? 'border-error ring-1 ring-error' : 'border-outline-variant/40' }} bg-surface-cream-light text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-secondary transition-all"
                            >
                        </div>
                    </div>

                    <!-- Nome do Responsável -->
                    <div class="space-y-1.5">
                        <label for="nome_responsavel" class="block text-xs font-bold uppercase tracking-wider text-on-surface">
                            Nome Completo do Responsável Legal <span class="text-error">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nome_responsavel" 
                            name="nome_responsavel" 
                            value="{{ $old['nome_responsavel'] ?? '' }}" 
                            required 
                            minlength="3" 
                            maxlength="100" 
                            placeholder="Ex: Mariana Ferreira Silva (Mãe / Pai / Responsável)"
                            class="w-full px-4 py-3 rounded-xl border {{ isset($erros['nome_responsavel']) ? 'border-error ring-1 ring-error' : 'border-outline-variant/40' }} bg-surface-cream-light text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-secondary transition-all"
                        >
                    </div>

                    <!-- Observações -->
                    <div class="space-y-1.5">
                        <label for="observacoes" class="block text-xs font-bold uppercase tracking-wider text-on-surface">
                            Observações ou Informações Importantes (Opcional)
                        </label>
                        <textarea 
                            id="observacoes" 
                            name="observacoes" 
                            rows="3" 
                            maxlength="255" 
                            placeholder="Ex: Alergias, disponibilidade de horários, ou experiência prévia com canto."
                            class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 bg-surface-cream-light text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-secondary transition-all"
                        >{{ $old['observacoes'] ?? '' }}</textarea>
                    </div>

                    <!-- Termos e Submissão -->
                    <div class="pt-4 border-t border-outline-variant/30 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <p class="text-xs text-text-muted">
                            Ao inscrever, você autoriza a participação nos ensaios presenciais no mês de dezembro na sede da IBNP.
                        </p>
                        <button 
                            type="submit" 
                            class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-8 py-3.5 rounded-xl bg-primary text-on-primary text-xs font-bold shadow-md hover:bg-secondary-container transition-all duration-200 active:scale-95 whitespace-nowrap"
                        >
                            <span class="material-symbols-outlined text-[18px]">how_to_reg</span>
                            <span>Garantir Vaga no Coral de Natal</span>
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <!-- Perguntas Frequentes & Detalhes da Oficina -->
        <section class="space-y-6 pt-4">
            <h3 class="text-xl font-extrabold text-on-surface text-center">Perguntas Frequentes sobre a Oficina</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs sm:text-sm">
                <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 space-y-2">
                    <span class="font-bold text-on-surface flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-secondary text-[18px]">calendar_month</span>
                        <span>Quando serão os ensaios?</span>
                    </span>
                    <p class="text-text-muted leading-relaxed">
                        Os ensaios preparatórios acontecerão ao longo do mês de dezembro na sede da igreja em Guapó, com cronograma informado diretamente no WhatsApp dos responsáveis.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 space-y-2">
                    <span class="font-bold text-on-surface flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-secondary text-[18px]">payments</span>
                        <span>Existe algum custo?</span>
                    </span>
                    <p class="text-text-muted leading-relaxed">
                        Não! A oficina é 100% gratuita, organizada e mantida com carinho pelo Programa de Desenvolvimento Infantil da IBNP para a comunidade de Guapó.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-surface-pure border border-outline-variant/30 space-y-2">
                    <span class="font-bold text-on-surface flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-secondary text-[18px]">music_cast</span>
                        <span>Precisa saber cantar?</span>
                    </span>
                    <p class="text-text-muted leading-relaxed">
                        Não é necessária experiência prévia! O objetivo da oficina é acolher as crianças, ensinando ritmo, respiração e canto coletivo com alegria e afeto.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
