# IBN da Paz de Guapó — Website Oficial

Portal oficial da **Igreja Batista Nacional da Paz de Guapó** (IBNP Guapó), fundada em 14 de janeiro de 1999 no município de Guapó-GO e filiada à Convenção Batista Nacional (CBN / CBN Goiás).

---

## 🏛️ Propósito e Pilares

1. **Acolhimento Comunitário:** Informações claras para visitantes, famílias e moradores de Guapó (endereço, mapa, horários e atendimento pastoral via WhatsApp).
2. **Programação & Cultos:** Agenda semanal dos cultos regulares (quartas e domingos) com exportação no padrão RFC 5545 iCalendar (`.ics`).
3. **Transparência & Governança Aberta:** Publicação e consulta pública irrestrita do **Estatuto Social** e do **Regimento Interno** sob o padrão semântico internacional **OASIS LegalDocML Akoma Ntoso 3.0**, versionados no Git de forma auditável.

---

## 🗺️ Mapa do Site & Rotas Canônicas

| Rota | Descrição | Formato / View |
| :--- | :--- | :--- |
| `/` | **Home:** Acolhimento, resumo dos cultos da semana, governança e localização | HTML / Blade |
| `/programacao` | **Programação:** Cultos semanais regulares e eventos especiais | HTML / Blade |
| `/programacao/ical` | **Feed iCalendar:** Sincronização direta com Google Calendar, Apple e Outlook | RFC 5545 (`.ics`) |
| `/estatuto` | **Estatuto Social:** Leitor interativo com sumário, busca e permalinks | Akoma Ntoso 3.0 |
| `/regimento` | **Regimento Interno:** Normas eclesiásticas, ministérios e ritos | Akoma Ntoso 3.0 |
| `/sobre` | **Sobre Nós:** História da IBN da Paz em Guapó-GO, declaração de fé e liderança | HTML / Blade |
| `/contato` | **Contato & Localização:** Mapa interativo, WhatsApp e canais oficiais | HTML / Blade |

---

## 🎨 Identidade Visual & Paleta Oficial

| Uso | Nome / Conceito | Hex | Aplicação |
| :--- | :--- | :--- | :--- |
| **Primária** | Coral Red | `#F43517` | Botões de ação principais (CTAs), badge "Ao Vivo", títulos de impacto |
| **Secundária** | Warm Orange | `#F36529` | Gradientes quentes, estados de hover, cartões secundários |
| **Terciária / Acento** | Peach Accent | `#EFA162` | Realces no leitor jurídico, bordas e tags |
| **Fundo Suave** | Warm Cream | `#F1D6A9` | Superfícies acolhedoras e avisos litúrgicos |
| **Neutros** | Branco Puro & Grafite | `#FFFFFF` / `#1E293B` | Fundo principal e texto acessível de alto contraste (WCAG AA) |

---

## 📍 Informações Institucionais (Guapó-GO)

- **Razão Social:** Igreja Batista Nacional da Paz de Guapó (CNPJ: `02.930.019/0001-62`)
- **Endereço:** Rua Presidente Kennedy, Qd. 21, Lt. 13 – Centro, Guapó – GO, CEP 75350-000
- **Cultos Regulares:**
  - **Quarta-feira às 19:30:** Culto de Oração e Estudo Bíblico
  - **Domingo às 19:30:** Culto de Celebração da Família
- **Canais:**
  - **Telefone / WhatsApp:** (62) 9870-0089 (`+55 62 9870-0089`)
  - **Instagram:** [@ibnp_guapo](https://instagram.com/ibnp_guapo)
  - **YouTube:** [@ibnpguapo](https://youtube.com/@ibnpguapo)

---

## 📚 Especificações Técnicas (WDLC / SDD)

O desenvolvimento deste portal segue a metodologia **Spec-Driven Development (SDD)**:

- [x] [SPEC-WDLC-F1: Arquitetura de Informação, Mapa do Site e Requisitos](docs/specs/01-arquitetura-informacao-requisitos.md) (Issue #1)
- [x] [SPEC-WDLC-F2: Design System, Prototipagem no Stitch e Acessibilidade](docs/specs/02-design-system-prototipagem.md) (Issue #2)
- [ ] WDLC-F3: Transcrição Estatuto Akoma Ntoso 3.0 (Issue #3)
- [ ] WDLC-F3: Transcrição Regimento Akoma Ntoso 3.0 (Issue #4)
- [ ] WDLC-F3: Modelagem JSON Schema da Agenda (Issue #5)
- [ ] WDLC-F4: Setup PHP 8.x, Tailwind e Docker (Issue #6)
- [ ] WDLC-F4: Parser Akoma Ntoso em PHP (Issue #7)
- [ ] WDLC-F4: Gerador de Calendário .ics (Issue #8)
- [ ] WDLC-F4: Views Blade da Home, Sobre e Contato (Issue #9)
- [ ] WDLC-F5: Suíte PHPUnit e Validação XSD (Issue #10)
- [ ] WDLC-F6/F7: CI/CD GitHub Actions e Governança Git (Issue #11)
