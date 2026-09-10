# [WDLC-F3] Especificação Técnica: Modelagem de Dados da Programação em JSON Schema

> **Identificador:** SPEC-WDLC-F3-AGENDA  
> **Status:** Aprovado e Implementado  
> **Referência GitHub:** [Issue #5](https://github.com/ibnp-guapo/website/issues/5)  
> **Arquivo Schema:** [`data/programacao/agenda.schema.json`](../../data/programacao/agenda.schema.json)  
> **Arquivo de Dados:** [`data/programacao/agenda.json`](../../data/programacao/agenda.json)  
> **Dependência:** [SPEC-WDLC-F1](01-arquitetura-informacao-requisitos.md) ([Issue #1](https://github.com/ibnp-guapo/website/issues/1)) e [SPEC-WDLC-F2](02-design-system-prototipagem.md) ([Issue #2](https://github.com/ibnp-guapo/website/issues/2))  
> **Organização:** [ibnp-guapo](https://github.com/ibnp-guapo) / [website](https://github.com/ibnp-guapo/website)  
> **Última Atualização:** 2026-09-10  

---

## 1. Visão Geral & Objetivos

Esta especificação formaliza a estrutura, os tipos e os critérios de validação para a agenda de cultos regulares e eventos da **IBN da Paz de Guapó** em `data/programacao/agenda.json`, regida pelo **JSON Schema Draft 2020-12** (`data/programacao/agenda.schema.json`).

O objetivo é estabelecer um contrato de dados único para:
1. Renderização das views em PHP/Blade (`/programacao` e widget na `/`).
2. Geração automática do feed iCalendar RFC 5545 (`/programacao/ical`).
3. Injeção de metadados semânticos **Schema.org** (`Church` / `Event`).
4. Testes de integridade automatizados no PHPUnit (`tests/Feature/AgendaSchemaTest.php`).

---

## 2. Grade Regular Canônica da Congregação

Em conformidade com a decisão institucional aprovada na Fase 1, a grade de cultos regulares da igreja concentra-se estritamente em **dois encontros semanais**:

| Dia da Semana | Horário | Nome do Culto | Categoria | Transmissão ao Vivo | Regra iCalendar (RRULE) |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Quarta-feira** | 19:30 | **Culto de Oração e Estudo Bíblico** | Intercessão e Ensino | `false` (Presencial) | `FREQ=WEEKLY;BYDAY=WE` |
| **Domingo** | 19:30 | **Culto de Celebração da Família** | Celebração e Louvor | `true` (YouTube Oficial) | `FREQ=WEEKLY;BYDAY=SU` |

*Aviso Normativo:* O JSON Schema valida e restringe `diaSemana` estritamente a `["domingo", "quarta-feira"]`. Não há culto aos sábados na grade regular.

---

## 3. Mapeamento para Feeds RFC 5545 (iCalendar)

O endpoint PHP `/programacao/ical` consumirá `data/programacao/agenda.json` para produzir o arquivo `.ics` em conformidade com o padrão internacional RFC 5545:

```text
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//IBN da Paz de Guapo//Agenda Oficial//PT
CALSCALE:GREGORIAN
METHOD:PUBLISH
X-WR-CALNAME:IBN da Paz de Guapó - Cultos
X-WR-TIMEZONE:America/Sao_Paulo

BEGIN:VEVENT
UID:culto-quarta-oracao-ensino@ibnpguapo.com.br
SUMMARY:Culto de Oração e Estudo Bíblico - IBN da Paz de Guapó
DESCRIPTION:Momento dedicado à oração congregacional e ao estudo expositivo sistemático das Sagradas Escrituras.
LOCATION:Templo Sede - Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro, Guapó - GO
RRULE:FREQ=WEEKLY;BYDAY=WE
DTSTART;TZID=America/Sao_Paulo:20260107T193000
DURATION:PT1H30M
END:VEVENT

BEGIN:VEVENT
UID:culto-domingo-celebracao-familia@ibnpguapo.com.br
SUMMARY:Culto de Celebração da Família - IBN da Paz de Guapó
DESCRIPTION:Culto congregacional com louvor, adoração, comunhão fraterna e ministração da Palavra de Deus para toda a família.
LOCATION:Templo Sede - Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro, Guapó - GO
RRULE:FREQ=WEEKLY;BYDAY=SU
DTSTART;TZID=America/Sao_Paulo:20260111T193000
DURATION:PT2H
END:VEVENT
END:VCALENDAR
```

---

## 4. Mapeamento para Metadados Estruturados Schema.org (JSON-LD)

Para otimização em motores de busca (Google Search / Google Maps), o cabeçalho HTML da página de programação injetará automaticamente os dados no padrão Schema.org:

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Church",
  "name": "Igreja Batista Nacional da Paz de Guapó",
  "alternateName": "IBN da Paz de Guapó",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Rua Presidente Kennedy, Qd. 21, Lt. 13",
    "addressLocality": "Guapó",
    "addressRegion": "GO",
    "postalCode": "75350-000",
    "addressCountry": "BR"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": -16.8315,
    "longitude": -49.5317
  },
  "telephone": "+55-62-9870-0089",
  "url": "https://ibnpguapo.com.br"
}
</script>
```

---

## 5. Validação Automatizada de Integridade

A conformidade do arquivo `data/programacao/agenda.json` com o schema Draft 2020-12 foi validada pelo script [`scripts/validate_agenda.py`](../../scripts/validate_agenda.py):
- **Validação de Sintaxe e Tipos:** 100% SUCCESS.
- **Regex de Horário (`^([01]\d|2[0-3]):[0-5]\d$`):** Todos os horários validados no formato 24h `HH:MM`.
- **Slugs Únicos (`^[a-z0-9-]+$`):** Todos os identificadores normalizados para URLs amigáveis.
