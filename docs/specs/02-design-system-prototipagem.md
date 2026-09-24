# [WDLC-F2] Especificação Técnica: Design System, Prototipagem no Stitch e Acessibilidade WCAG 2.1 AA

> **Identificador:** SPEC-WDLC-F2  
> **Status:** Aprovado  
> **Referência GitHub:** [Issue #2](https://github.com/ibnp-guapo/website/issues/2)  
> **Dependência:** [SPEC-WDLC-F1](01-arquitetura-informacao-requisitos.md) ([Issue #1](https://github.com/ibnp-guapo/website/issues/1))  
> **Organização:** [ibnp-guapo](https://github.com/ibnp-guapo) / [website](https://github.com/ibnp-guapo/website)  
> **Última Atualização:** 2026-09-10  

---

## 1. Visão Geral & Objetivos

Esta especificação técnica formaliza o **Design System**, os **Tokens de Estilo no Tailwind CSS**, a **Auditoria Matemática de Acessibilidade de Cores (WCAG 2.1 AA)** e os **Prompts Canônicos de Prototipagem de Alta Fidelidade no Stitch** para a presença web oficial da **IBN da Paz de Guapó** (`ibnp-guapo/website`).

O objetivo é garantir consistência estética, acolhimento visual de alto impacto e conformidade rigorosa com normas internacionais de acessibilidade digital e legibilidade jurídica.

---

## 2. Paleta Oficial & Auditoria de Acessibilidade (WCAG 2.1 AA)

### 2.1 Especificação dos Tokens de Cor

A paleta institucional da IBN da Paz de Guapó combina tons solares, acolhedores e elegantes, contrastados com neutros de alta definição:

| Token | Nome / Conceito | Hex | RGB | Luminância ($L$) | Função Primária |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `primary` | Coral Red | `#F43517` | `244, 53, 23` | $0.2181$ | CTAs de alto impacto, badges de transmissão "Ao Vivo", títulos |
| `secondary` | Warm Orange | `#F36529` | `243, 101, 41` | $0.2642$ | Gradientes quentes, estados de hover, cartões secundários |
| `accent` | Peach Accent | `#EFA162` | `239, 161, 98` | $0.4485$ | Bordas delicadas, tags de ministérios, realces no leitor jurídico |
| `surface` | Warm Cream | `#F1D6A9` | `241, 214, 169` | $0.6872$ | Fundo suave de seções de acolhimento, avisos e sidebars |
| `dark` | Grafite Escuro | `#1E293B` | `30, 41, 59` | $0.0223$ | Tipografia principal de leitura (altíssimo contraste) |
| `light` | Branco Puro | `#FFFFFF` | `255, 255, 255` | $1.0000$ | Superfície de fundo principal e texto sobre botões escuros |

### 2.2 Auditoria Matemática de Contraste W3C

A fórmula oficial de razão de contraste ($CR$) da especificação W3C WCAG 2.1 é dada por:
$$CR = \frac{L_1 + 0.05}{L_2 + 0.05}$$
onde $L_1$ é a luminância relativa da cor mais clara e $L_2$ da cor mais escura ($0.0 \le L \le 1.0$).

#### Resultados dos Pares de Cores:

1. **Texto Escuro (`#1E293B`) sobre Fundo Branco Puro (`#FFFFFF`):**
   $$CR = \frac{1.0000 + 0.05}{0.0223 + 0.05} = \frac{1.0500}{0.0723} \approx 14.52:1$$
   - **Resultado:** ✅ **Supera Nível AAA** (Exigência: 7.0:1). Ideal para leitura prolongada de artigos do Estatuto e Regimento.

2. **Texto Escuro (`#1E293B`) sobre Fundo Creme Suave (`#F1D6A9`):**
   $$CR = \frac{0.6872 + 0.05}{0.0223 + 0.05} = \frac{0.7372}{0.0723} \approx 10.19:1$$
   - **Resultado:** ✅ **Supera Nível AAA** (Exigência: 7.0:1). Indicado para sidebars litúrgicas e cartões de avisos.

3. **Texto Escuro (`#1E293B`) sobre Fundo Pêssego Acento (`#EFA162`):**
   $$CR = \frac{0.4485 + 0.05}{0.0223 + 0.05} = \frac{0.4985}{0.0723} \approx 6.89:1$$
   - **Resultado:** ✅ **Aprovado Nível AA para Texto Normal** (Exigência: 4.5:1) e AAA para texto grande. Indicado para tags e badges.

4. **Texto Branco Puro (`#FFFFFF`) sobre Botão Coral Primário (`#F43517`):**
   $$CR = \frac{1.0000 + 0.05}{0.2181 + 0.05} = \frac{1.0500}{0.2681} \approx 3.92:1$$
   - **Resultado:** ✅ **Aprovado Nível AA para Elementos de Interface e Texto Grande** (Exigência: 3.0:1 para elementos interativos, componentes gráficos e textos $\ge 18\text{px}$ ou $\ge 14\text{px}$ em negrito).
   - **Diretriz de Uso Obrigatória:** Todos os botões e CTAs com fundo `#F43517` devem utilizar tipografia branca com peso `font-semibold` ou `font-bold` e tamanho mínimo de 14px (`text-sm font-semibold` ou `text-base font-bold`).
   - **Restrição:** É terminantemente proibido utilizar `#F43517` como cor de texto corrido fino sobre fundo branco, devendo ser restrito a títulos de grande porte (`text-2xl+ font-bold`), ícones, badges e superfícies de botões.

---

## 3. Prompts Canônicos de Alta Fidelidade no Stitch

Os prompts abaixo refletem rigorosamente a taxonomia, as rotas e os dados oficiais aprovados na Fase 1 (cultos de quarta e domingo, contatos oficiais em Guapó-GO e identidade visual):

### 3.1 Prompt Stitch: Home (Página Inicial)
```text
Create a clean, welcoming, and ultra-accessible church homepage for "IBN da Paz de Guapó" located in Guapó-GO.
Color palette:
- Primary coral red: #F43517 (for high-impact CTAs and live badges)
- Secondary warm orange: #F36529 (hover states and warm gradients)
- Peach accent: #EFA162 (subtle borders, ministry tags)
- Warm cream: #F1D6A9 (warm secondary background blocks)
- Neutral dark: #1E293B (accessible body text)
- Neutral light: #FFFFFF (clean surface)

Header:
- Church brand: "IBN da Paz de Guapó" with subtle elegant cross/dove icon.
- Navigation links: Início, Programação, Estatuto Social, Regimento Interno, Sobre Nós, Contato.
- Highlighted CTA button in #F43517: "Como Chegar / Horários".

Hero Section:
- Headline: "Um lugar de paz, comunhão e adoração a Deus em Guapó".
- Subtitle: "Seja muito bem-vindo à nossa congregação. Conheça nossos cultos semanais e faça parte da nossa família."
- Primary CTA: "Cultos da Semana" (#F43517) and Secondary CTA: "Como Chegar" (border in #F36529).

Weekly Services Widget:
- Two focused cards (Wednesday & Sunday only):
  1) Quarta-feira 19:30: Culto de Oração e Estudo Bíblico (Intercessão congregacional e ministração da Palavra).
  2) Domingo 19:30: Culto de Celebração da Família (Badge in #F43517: Transmissão ao Vivo).

Governance & Civic Transparency Section:
- Clean card highlighting open institutional governance: "Transparência & Estatuto Social".
- Clear badges: "Padrão Internacional Akoma Ntoso 3.0" and "Acesso Aberto & Livre".
- Direct links to read "Estatuto Social" and "Regimento Interno".

Guapó Location & Contact Banner:
- Physical address: Rua Presidente Kennedy, Qd. 21, Lt. 13 – Centro, Guapó – GO, CEP 75350-000.
- Quick WhatsApp button (+55 62 99870-0089) and Instagram link (@ibnp_guapo).
- Responsive Google Maps embed container.

Footer:
- Church official name (CNPJ 02.930.019/0001-62, fundação em 1999, filiada à CBN).
- Navigation links, Legal docs links, and Copyright.
```

### 3.2 Prompt Stitch: Programação & Calendário
```text
Design an accessible and mobile-first church schedule & event page for "IBN da Paz de Guapó".
Palette: #F43517 (coral red), #F36529 (warm orange), #EFA162 (peach), #F1D6A9 (warm cream), #1E293B (text), #FFFFFF (cards).

Header:
- Title: "Programação & Cultos"
- Subtitle: "Acompanhe nossa grade de cultos semanais e eventos especiais em Guapó-GO"
- Highlighted action button: "Adicionar à Minha Agenda (.ics)" with calendar download icon.

Tab Controls:
- Tabs: "Cultos Regulares" (active by default) and "Eventos Especiais".

Service Cards (Cultos Regulares):
- Card 1: "Culto de Oração e Estudo Bíblico"
  - Day & Time: Quarta-feira às 19:30
  - Ministry: Ensino Bíblico & Intercessão
  - Description: "Momento dedicado à oração congregacional e estudo expositivo das Sagradas Escrituras."
- Card 2: "Culto de Celebração da Família"
  - Day & Time: Domingo às 19:30
  - Ministry: Louvor, Comunhão & Celebração
  - Badge in #F43517: "Transmissão ao Vivo" with live indicator
  - Description: "Culto congregacional com louvor, adoração, comunhão e ministração para toda a família."

Action Bar:
- Sincronização: Card explicativo sobre a importação automática do arquivo .ics no Google Calendar, Apple Calendar e Outlook.
```

### 3.3 Prompt Stitch: Leitor Jurídico Akoma Ntoso 3.0
```text
Design a split-pane, high-accessibility web reader for open legal documents (Church Bylaws / "Estatuto Social" & "Regimento Interno") adhering to the OASIS LegalDocML Akoma Ntoso 3.0 standard.
Palette: Accents in #F43517 and #EFA162, warm sidebar in #F1D6A9, dark text in #1E293B, crisp white reading pane #FFFFFF.

Top Metadata Bar:
- Document Title: "Estatuto Social — Igreja Batista Nacional da Paz de Guapó"
- Metadata pills: "Padrão Akoma Ntoso 3.0 XML", "Versão Vigente", "Registro Cartório Comarca de Guapó".
- Action buttons: "Baixar XML Akoma Ntoso" and "Imprimir / PDF".

Two-Column Split Layout:
- Left Column (Sticky Sidebar, 30% width):
  - Instant live search input with peach highlight on match: "Pesquisar artigos ou palavras-chave...".
  - Expandable Table of Contents tree (Capítulo I: Denominação e Sede, Capítulo II: Dos Membros, Capítulo III: Da Administração, etc.).
  - Article anchor counter: Art. 1º, Art. 2º, etc.
- Right Column (Reading Pane, 70% width):
  - Elegant serif typography (e.g. Merriweather or Lora) for legal devices.
  - Distinct article headings: "Artigo 1º", "Artigo 2º" with copy permalink anchor button (#art_1, #art_2).
  - Paragraphs with semantic indentation (§ 1º, Parágrafo único, Incisos I, II).
  - Subtle highlight animation (pulse effect with #EFA162) when navigated via direct URL anchor.
```

---

## 4. Contratos de Estilo: Tokens Tailwind CSS

A configuração do Tailwind CSS no projeto (`tailwind.config.js`) deve seguir estritamente o contrato:

```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/Views/**/*.blade.php",
    "./public/**/*.php",
    "./public/assets/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        ibnp: {
          primary: '#F43517',   // Coral Red (Ações, CTA, Ao Vivo)
          secondary: '#F36529', // Warm Orange (Hover, Gradientes)
          accent: '#EFA162',    // Peach Accent (Bordas, Realces de Leitura)
          surface: '#F1D6A9',   // Warm Cream (Fundo de Avisos/Liturgia)
          dark: '#1E293B',      // Slate Dark (Texto acessível)
          light: '#FFFFFF',     // Branco Puro
        }
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
        serif: ['Merriweather', 'Georgia', 'serif'], // Tipografia jurídica de alta legibilidade
      },
      boxShadow: {
        'warm': '0 4px 20px -2px rgba(243, 101, 41, 0.12)',
        'warm-lg': '0 10px 25px -3px rgba(244, 53, 23, 0.15)',
      }
    },
  },
  plugins: [],
}
```

---

## 5. Casos de Borda de Design & Resoluções

| Cenário de Interface | Comportamento de Design Esperado | Regra Visual |
| :--- | :--- | :--- |
| **Visualização em Dispositivo Móvel (< 768px)** | O leitor jurídico esconde a coluna esquerda e disponibiliza um botão flutuante *"Sumário & Busca"* que abre gaveta lateral (drawer). | Garantir 100% de largura de leitura sem corte de margem. |
| **Artigo Marcado via Hash URL (`#art_14`)** | Ao carregar a página com âncora, o navegador executa scroll suave e aplica a classe `.highlight-pulse` com fundo `#F1D6A9` e borda `#EFA162`. | O leitor imediatamente identifica o dispositivo citado. |
| **Texto de Botão em `#F43517`** | Deve ser sempre branco `#FFFFFF` com `font-semibold` ou `font-bold` e tamanho mínimo de `text-sm font-semibold` (14px) ou `text-base` (16px). | Cumprimento absoluto do critério WCAG AA (3:1 para UI/large text). |
| **Campo de Busca com Termo Sem Correspondência** | Exibe estado vazio elegante com ícone suave e botão de reset: *"Nenhum dispositivo legal encontrado para '[termo]'."* | Preservar a integridade visual sem quebrar o layout. |

---

## 6. Rastreabilidade com as Fases Subsequentes

- **Fase 3 (Modelagem XML Akoma Ntoso & JSON Schema):** Utilizará os marcadores semânticos de capítulos, artigos e incisos definidos para o leitor.
- **Fase 4 (Desenvolvimento PHP & Views Blade):** Consumirá os tokens do `tailwind.config.js` e as estruturas visuais definidas nos mockups.
- **Fase 5 (QA & Acessibilidade):** Testará os contrastes de cores calculados nesta especificação via ferramentas automatizadas (Lighthouse CI / Pa11y).
