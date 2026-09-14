# [WDLC-F5] Especificação Técnica: Suíte de Testes PHPUnit e Auditoria de Acessibilidade (WCAG 2.1 AA)

> **Identificador:** SPEC-WDLC-F5-TESTES-ACESSIBILIDADE  
> **Status:** Proposto para Aprovação  
> **Referência GitHub:** [Issue #10](https://github.com/ibnp-guapo/website/issues/10)  
> **Dependências:** [Issue #7](https://github.com/ibnp-guapo/website/issues/7), [Issue #8](https://github.com/ibnp-guapo/website/issues/8), [Issue #9](https://github.com/ibnp-guapo/website/issues/9)  
> **Organização:** [ibnp-guapo](https://github.com/ibnp-guapo) / [website](https://github.com/ibnp-guapo/website)  
> **Última Atualização:** 2026-09-14  

---

## 1. Objetivo & Escopo

### 1.1 Contexto e Problema
O website da Igreja Batista Nacional da Paz de Guapó (IBNP Guapó) integra documentos legislativos/estatutários em padrão aberto internacional (OASIS LegalDocML Akoma Ntoso 3.0), agenda litúrgica com sincronização iCal (RFC 5545) e JSON Schema, além de rotas institucionais construídas com Blade e TailwindCSS. É essencial garantir de forma contínua e automatizada:
1. A conformidade estrita dos arquivos XML com o schema oficial OASIS Akoma Ntoso 3.0 (`akomantoso30.xsd`);
2. A unicidade e padronização semântica dos identificadores estruturais (`eId`);
3. A integridade da agenda contra o JSON Schema Draft 2020-12;
4. A integridade das rotas HTTP (status 200, cabeçalhos MIME e página 404);
5. A conformidade de acessibilidade digital nível AA (WCAG 2.1), especialmente o contraste da paleta institucional e navegabilidade por teclado/leitores de tela.

### 1.2 Objetivos no Escopo (Goals)
- **OASIS Schema Local:** Disponibilizar os schemas oficiais `schemas/akomantoso30.xsd` e o schema dependente `schemas/xml.xsd` no repositório para viabilizar validação XSD offline determinística.
- **Correção da Estrutura do Estatuto XML:** Adequar a hierarquia do XML `data/legal/estatuto-social.akn.xml` de modo que artigos com parágrafos subsequentes utilizem `<intro>` em vez de `<content>` para o caput, em conformidade com o tipo `hierarchy` do Akoma Ntoso 3.0 XSD.
- **Suíte LegalDocs (`tests/LegalDocs/AkomaNtosoValidationTest.php`):**
  - Validação de `DOMDocument::schemaValidate('schemas/akomantoso30.xsd')`.
  - Validação de unicidade e convenção dos `eId` (`art_X`, `cap_X`, `art_X_par_Y`, etc.).
  - Validação dos metadados FRBR e consistência semântica.
- **Validação de Schema de Programação:**
  - Teste automatizado validando `data/programacao/agenda.json` contra `data/programacao/agenda.schema.json` via PHPUnit.
- **Suíte de Rotas HTTP (`tests/Feature/HttpRoutesTest.php`):**
  - Testes de resposta HTTP 200 e validação de `Content-Type` para todas as rotas canônicas: `/`, `/programacao`, `/programacao/ical`, `/estatuto`, `/estatuto/xml`, `/regimento`, `/regimento/xml`, `/sobre`, `/contato`.
  - Validação de resposta HTTP 404 para rotas inexistentes (`/rota-inexistente`).
- **Auditoria de Acessibilidade (WCAG 2.1 AA):**
  - Teste automatizado PHPUnit (`tests/Feature/AccessibilityWcagTest.php`) validando contraste cromático das cores institucionais (coral `#F43517`, laranja `#F36529`, azul institucional, contrastes com fundos claros/escuros conforme fórmula WCAG de luminância relativa), além de verificar landmarks semânticos (`main`, `nav`, `header`, `footer`), skip links, atributos `aria-*` e atributos de navegação por teclado (`tabindex`, links de âncora) no leitor do estatuto.
  - Script Node.js de verificação automatizada (`scripts/audit_accessibility.js` / Pa11y runner).
- **Configuração do Test Runner:**
  - Atualização do `phpunit.xml` para incluir a nova suíte `LegalDocs`.
  - Configuração do `composer test` no `composer.json` para rodar toda a suíte.

### 1.3 Fora do Escopo (Non-Goals)
- Transcrição do Regimento Interno (objeto da Issue #4). Quando `regimento-interno.akn.xml` não existir em disco, o teste deve verificar graciosamente seu estado de transição sem falso-positivo.
- Modificação de regras de negócio ou design visual das páginas já homologadas nas fases anteriores.

---

## 2. Contratos, Arquitetura & Modelagem

### 2.1 Estrutura de Diretórios e Arquivos
```
schemas/
├── akomantoso30.xsd         # OASIS Akoma Ntoso 3.0 XSD oficial
└── xml.xsd                  # W3C XML Namespace Schema (import dependente)

tests/
├── LegalDocs/
│   └── AkomaNtosoValidationTest.php   # Validação XSD e eId semântico
├── Feature/
│   ├── HttpRoutesTest.php             # Requisições HTTP (200 / 404 / Content-Type)
│   ├── AccessibilityWcagTest.php      # Verificações WCAG 2.1 AA (contraste e ARIA)
│   ├── LegalDocRoutesTest.php
│   ├── PageRoutesTest.php
│   ├── ProgramacaoRoutesTest.php
│   └── RoutesTest.php
└── Unit/
    ├── AgendaValidationTest.php       # Validação da agenda JSON contra schema
    ├── AkomaNtosoParserTest.php
    ├── ICalGeneratorTest.php
    └── RouterSetupTest.php

scripts/
└── audit_accessibility.js             # Script de auditoria Pa11y / axe-core para CLI
```

### 2.2 Contrato de Validação Akoma Ntoso 3.0
- O arquivo `data/legal/estatuto-social.akn.xml` deve ser validado com:
```php
$dom = new DOMDocument();
$dom->load($xmlPath);
$isValid = $dom->schemaValidate($xsdPath);
```
- Em Akoma Ntoso 3.0, artigos que contêm `<paragraph>` ou `<clause>` filhos devem estruturar o caput como `<intro><p>...</p></intro>` para cumprir a gramática do tipo complexo `hierarchy`.
- O parser `AkomaNtosoParser` deve ler o caput com a query XPath unificada `akn:intro/akn:p | akn:intro | akn:content/akn:p | akn:content`, mantendo retrocompatibilidade total.

### 2.3 Contrato de Validação da Agenda (JSON Schema)
- Validação das chaves obrigatórias (`organizacao`, `cultosRegulares`, `eventosEspeciais`, `metadados`), formatos de string (ISO 8601, expressões RRULE, cores hexadecimais `#RRGGBB`, etc.).

### 2.4 Contrato de Teste de Rotas HTTP (`HttpRoutesTest`)
- A suíte deve testar cada rota da aplicação simulando o ciclo de vida ou invocação controlada de buffer:
  - `GET /` -> HTTP 200, `text/html`, contém título e seções da Home.
  - `GET /programacao` -> HTTP 200, `text/html`, contém culto regular e schema.org.
  - `GET /programacao/ical` -> HTTP 200, `text/calendar; charset=utf-8`, contém `BEGIN:VCALENDAR`.
  - `GET /estatuto` -> HTTP 200, `text/html`, contém `ESTATUTO DA IGREJA`.
  - `GET /estatuto/xml` -> HTTP 200, `application/xml`, contém `<akomaNtoso>`.
  - `GET /regimento` -> HTTP 200, `text/html`, contém aviso ou conteúdo do Regimento.
  - `GET /regimento/xml` -> HTTP 404 (enquanto pendente transcrição) ou HTTP 200 (se existir).
  - `GET /sobre` -> HTTP 200, `text/html`, contém histórico e filiação CBN.
  - `GET /contato` -> HTTP 200, `text/html`, contém canais e mapa.
  - `GET /rota-inexistente` -> HTTP 404, `text/html`, visualizador de erro 404 amigável.

### 2.5 Contrato de Acessibilidade (WCAG 2.1 Nível AA)
- **Contraste de Cores:**
  - Fórmula WCAG de luminância relativa: $(L_1 + 0.05) / (L_2 + 0.05) \ge 4.5:1$ para texto normal e $\ge 3:1$ para texto grande / elementos gráficos.
  - Testes específicos para os tokens de marca: Vermelho Coral (`#F43517`), Laranja Primário (`#F36529`), Azul Institucional (`#0F172A`), Fundo Claro (`#F8FAFC`), garantindo que qualquer combinação de texto e fundo empregada nas views atenda a WCAG 2.1 AA.
- **Estrutura ARIA e Teclado:**
  - Presença de atributos `aria-label`, `role`, `tabindex`, elementos semânticos `<main>`, `<nav>`, `<header>`, `<footer>`.
  - Presença de permalinks e IDs semânticos para navegação interna acessível no estatuto social.

---

## 3. Casos de Borda & Tratamento de Falhas

1. **Documentos em Transcrição (`regimento-interno.akn.xml`):**
   - Se o arquivo não existir em `data/legal/`, o teste de schema deve identificar a condição e reportar como transição documentada (sem quebrar a suíte), mas se o arquivo for adicionado no futuro, ele é automaticamente validado contra o XSD.
2. **Ambiente Offline / Sem Internet:**
   - O validador de XSD não deve realizar chamadas externas de rede; todos os schemas necessários (`akomantoso30.xsd` e `xml.xsd`) devem residir localmente em `schemas/`.
3. **LibXML Errors:**
   - Utilizar `libxml_use_internal_errors(true)` e capturar mensagens descritivas para facilitar o diagnóstico de eventuais erros de schema ou formato XML.
4. **Resoluções de Rota com Parâmetros ou Query Strings:**
   - Garantir que permalinks com hash ou parâmetros não causem falso negativo na suíte HTTP.

---

## 4. Critérios de Aceitação & Plano de Verificação

### Critérios de Aceitação (Definition of Done)
- [ ] Schemas oficiais `akomantoso30.xsd` e `xml.xsd` adicionados em `schemas/`.
- [ ] `data/legal/estatuto-social.akn.xml` validado 100% sem erros contra `schemas/akomantoso30.xsd`.
- [ ] `tests/LegalDocs/AkomaNtosoValidationTest.php` criado e passando com asserções de XSD, unicidade de `eId` e metadados.
- [ ] `tests/Feature/HttpRoutesTest.php` criado e validando todas as rotas principais (200, 404 e cabeçalhos).
- [ ] `tests/Feature/AccessibilityWcagTest.php` criado e validando contraste e semântica WCAG 2.1 AA.
- [ ] Script de acessibilidade (`scripts/audit_accessibility.js`) criado e executável.
- [ ] `phpunit.xml` configurado com a suíte `LegalDocs`.
- [ ] `composer test` executando toda a bateria com sucesso (`OK (X tests, Y assertions)`).
