# Especificação Técnica: Módulo de Programação de Cultos e Gerador de Calendário (.ics) em PHP

- **Identificador:** `SPEC-WDLC-F4-08`
- **Fase do WDLC:** F4 - Desenvolvimento em PHP
- **Issue Relacionada:** [#8](https://github.com/ibnp-guapo/website/issues/8)
- **Status:** Aprovado e Implementado
- **Data:** 10/09/2026

---

## 1. Objetivo & Escopo

### 1.1 Objetivo
Desenvolver o módulo de apresentação da **Programação Semanal de Cultos e Encontros** da **Igreja Batista Nacional da Paz de Guapó** em PHP, consumindo a fonte canônica `data/programacao/agenda.json`, provendo exportação no padrão **RFC 5545 iCalendar (`.ics`)** para sincronização com aplicativos de calendário (Google, Apple, Outlook) e estruturação semântica **Schema.org** para indexação nos mecanismos de busca.

### 1.2 Regras Litúrgicas Institucionais
- **Cultos Regulares:**
  - **Quarta-feira das 19:30 às 21:00 (90 min):** Culto de Oração e Estudo Bíblico.
  - **Domingo das 19:30 às 21:00 (90 min):** Culto de Celebração da Família.
  - *Todos os cultos são 100% presenciais no Templo Sede (sem transmissão ao vivo).*
  - *Não há cultos aos sábados.*

---

## 2. Componentes Desenvolvidos

1. **Modelos de Dados (`App\DTO`):**
   - `AgendaDto`: Estrutura de dados agregando organização, endereço formatado, canais, cultos regulares e eventos especiais.
   - `CultoRegularDto`: Representação de cada culto com cálculo automático de horário de término (`getHorarioFim()`) e regra de recorrência `rrule`.
2. **Serviço de Calendário (`App\Services\ICalGenerator`):**
   - Construtor do formato padrão RFC 5545 com cabeçalhos `BEGIN:VCALENDAR`, `VERSION:2.0`, `X-WR-CALNAME` e fuso horário canônico `America/Sao_Paulo`.
   - Geração de blocos `VEVENT` recorrentes com `RRULE:FREQ=WEEKLY;BYDAY=WE` e `RRULE:FREQ=WEEKLY;BYDAY=SU`.
   - Escape rigoroso de caracteres literais (vírgulas, pontos-e-vírgulas e quebras de linha).
3. **Controller (`App\Controllers\ProgramacaoController`):**
   - **`index()`:** Renderiza a página `/programacao` com design system oficial da igreja, cards visuais dos cultos de quarta e domingo, botões "Adicionar ao Google Agenda" (via deep-link web com recorrência) e "Baixar .ics", além de injeção de bloco JSON-LD Schema.org (`Event` / `Place` / `Organization`).
   - **`ical()`:** Fornece o arquivo `cultos-ibnp-guapo.ics` com cabeçalhos `Content-Type: text/calendar; charset=utf-8` e `Content-Disposition: attachment`.

---

## 3. Cobertura de Testes Automatizados

A suíte no PHPUnit 11 valida:
- **`Tests\Unit\ICalGeneratorTest`:**
  - Conformidade RFC 5545 (`BEGIN:VCALENDAR`, `BEGIN:VTIMEZONE`, `END:VCALENDAR`).
  - Presença dos 2 cultos regulares de 90 minutos (19:30 às 21:00).
  - Ausência de eventos aos sábados.
- **`Tests\Feature\ProgramacaoRoutesTest`:**
  - Renderização completa de `/programacao` com Schema.org JSON-LD.
  - Ausência de menção a transmissões ao vivo.
  - Validação de integridade dos dados retornados pelo método `loadAgenda()`.
