# Especificação Técnica 13: Ajustes do Culto de Domingo (Celebração) e Correção do Sumário Mobile no Estatuto Social

- **Autor:** Antigravity Agent
- **Data:** 2026-09-20
- **Status:** Proposta (Aguardando Aprovação do Usuário)
- **Metodologia:** Spec-Driven Development (SDD) & Test-Driven Development (TDD)

---

## 1. Objetivo & Escopo

### Contexto
Foram identificados dois pontos de melhoria e correção no website institucional da IBN da Paz de Guapó:
1. **Denominação do Culto de Domingo:** O culto de domingo não possui temática familiar específica; trata-se estritamente do culto congregacional de celebração semanal. O título atual ("Culto de Celebração da Família") deve ser ajustado para **"Culto de Celebração"**, removendo as restrições temáticas nos textos descritivos.
2. **Sobreposição do Sumário no Mobile (Estatuto Social e Regimento Interno):** Na versão mobile (< 1024px), o `<aside>` que contém o sumário e a barra de busca possui posicionamento `sticky top-24 max-h-[calc(100vh-8rem)]` sem restrição de breakpoint (`lg:`). Em telas estreitas de coluna única, o elemento permanece fixado no topo da viewport enquanto o leitor rola o conteúdo, sobrepondo-se visualmente aos artigos do documento legal.

### Goals (Dentro do Escopo)
- **G1 (Culto de Domingo - Celebração):**
  - Atualizar `data/programacao/agenda.json`:
    - `id`: `culto-domingo-celebracao`
    - `nome`: `"Culto de Celebração"`
    - `categoria`: `"Celebração e Louvor"`
    - `descricao`: `"Culto congregacional com louvor, adoração, comunhão fraterna e ministração da Palavra de Deus."`
  - Atualizar os templates de apresentação (`views/pages/home.blade.php` e `views/pages/contato.blade.php`) para refletir "Culto de Celebração".
  - Atualizar a suíte de testes (`tests/Unit/ICalGeneratorTest.php`, `tests/Feature/ProgramacaoRoutesTest.php` e `tests/Feature/PageRoutesTest.php`).
- **G2 (Correção de Layout Mobile do Sumário no Estatuto e Regimento):**
  - Corrigir a classe de posicionamento do `<aside>` em `views/pages/legal/estatuto.blade.php` e `views/pages/legal/regimento.blade.php` para ativar `sticky`, `top-24`, `max-h-[calc(100vh-8rem)]` e `overflow-y-auto` apenas no breakpoint desktop (`lg:sticky lg:top-24 lg:max-h-[calc(100vh-8rem)] lg:overflow-y-auto`).
  - Adicionar controle de colapso/expansão do sumário no mobile (`toc-mobile-toggle`), mantendo o sumário colapsado por padrão em telas pequenas (`hidden lg:block`), evitando rolagem excessiva antes de chegar aos artigos.
  - Atualizar os testes em `tests/Feature/LegalDocRoutesTest.php` para validar as classes responsivas e elementos do sumário mobile.

### Non-Goals (Fora do Escopo)
- Modificar o Culto de Ensino de quarta-feira (19:30).
- Alterar o conteúdo do arquivo Akoma Ntoso XML (`estatuto-social.akn.xml`).
- Alterar o parser ou o motor de busca instantânea além da acomodação do sumário colapsável.

---

## 2. Contratos & Modelagem

### 2.1 Schema de Dados da Agenda (`data/programacao/agenda.json`)
O item de domingo no array `cultosRegulares` passa a obedecer ao contrato:
```json
{
  "id": "culto-domingo-celebracao",
  "diaSemana": "domingo",
  "horario": "19:30",
  "duracaoMinutos": 90,
  "nome": "Culto de Celebração",
  "categoria": "Celebração e Louvor",
  "local": "Templo Sede - Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro, Guapó - GO",
  "descricao": "Culto congregacional com louvor, adoração, comunhão fraterna e ministração da Palavra de Deus.",
  "transmissaoAoVivo": false,
  "rrule": "FREQ=WEEKLY;BYDAY=SU"
}
```

### 2.2 Contrato do iCalendar RFC 5545 (`/programacao.ics` & `/programacao/ical`)
- **UID:** `UID:culto-domingo-celebracao@ibnpguapo.org.br`
- **SUMMARY:** `SUMMARY:Culto de Celebração - IBN da Paz de Guapó`
- **RRULE:** `RRULE:FREQ=WEEKLY;BYDAY=SU`
- **DTSTART / DTEND:** `193000` / `210000` (90 min)

### 2.3 Contrato de Layout Responsivo do Sumário Legal
- **Aside:**
  ```html
  <aside class="lg:col-span-4 bg-surface-pure rounded-3xl border border-outline-variant/30 p-6 elevation-warm-1 lg:sticky lg:top-24 lg:max-h-[calc(100vh-8rem)] lg:overflow-y-auto">
  ```
- **Toggle Mobile do Sumário:**
  - Botão com id `toc-mobile-toggle` exibido apenas em `lg:hidden`.
  - Container com id `toc-container` com classes `hidden lg:block`.
  - No clique, alterna a classe `hidden` e a rotação do ícone `expand_more`.

---

## 3. Casos de Borda & Falhas (Edge Cases)

1. **Restauração de Permalink/Âncora de Artigo (#art_X):**
   - Ao acessar uma URL direta com hash (ex: `/estatuto#art_12`), a página deve rolar suavemente até o artigo e aplicar o efeito pulse sem que o sumário fique fixado sobre o artigo no mobile.
2. **Busca Instantânea com Sumário Oculto no Mobile:**
   - A barra de busca no mobile permanece sempre visível na parte superior do `<aside>`, permitindo ao usuário filtrar artigos instantaneamente sem necessidade de abrir o sumário.
3. **Consistência Semântica no iCalendar e Schema.org:**
   - O feed iCal (.ics) e o JSON-LD de Eventos devem gerar o nome "Culto de Celebração" de forma sincronizada com o `agenda.json`.

---

## 4. Critérios de Aceitação & Plano de Verificação

### Critérios de Aceitação (Checklist):
- [ ] `agenda.json` possui `nome: "Culto de Celebração"` e `id: "culto-domingo-celebracao"`.
- [ ] Home (`/`) e Contato (`/contato`) exibem "Culto de Celebração" para os domingos às 19:30.
- [ ] Programação (`/programacao`) e feed iCal (`/programacao.ics`) exibem "Culto de Celebração".
- [ ] `<aside>` em `/estatuto` e `/regimento` não possui `sticky` incondicional no mobile, eliminando a sobreposição de texto.
- [ ] Sumário possui botão de alternância no mobile (`#toc-mobile-toggle`), iniciando recolhido para otimizar leitura do texto legal.
- [ ] 100% dos testes PHPUnit passam sem regressões.
- [ ] Compilação de CSS Tailwind (`npm run build:css`) executada sem erros.
