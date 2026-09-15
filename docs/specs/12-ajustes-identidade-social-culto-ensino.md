# Especificação Técnica 12: Ajustes de Identidade Visual (Logo), Link de Ação Social e Culto de Ensino de Quarta-feira

- **Autor:** Antigravity Agent
- **Data:** 2026-09-15
- **Status:** Proposta (Aguardando Aprovação do Usuário)
- **Metodologia:** Spec-Driven Development (SDD) & Test-Driven Development (TDD)

---

## 1. Objetivo & Escopo

### Contexto
O portal institucional da Igreja Batista Nacional da Paz de Guapó-GO requer três correções pontuais e refinamentos de conteúdo solicitados pela liderança:
1. Aplicação da identidade visual canônica (Logo oficial da igreja) hospedada e aprovada no Stitch Google (`projects/6725281104397729478?node-id=3101a950d99743ad80e51552d818b041`).
2. Atualização do link institucional do projeto de responsabilidade e ação social mantido pela igreja de `https://escolasocialguapo.org.br` para o domínio oficial da iniciativa: `https://social.ibnpguapo.org.br/`.
3. Ajuste de escopo da liturgia semanal de quarta-feira: o culto de quarta-feira é estritamente **Culto de Ensino** (exposição bíblica e doutrinária sistemática), e não culto de oração/intercessão coletiva.

### Goals (Dentro do Escopo)
- **G1 (Logo Oficial Stitch):**
  - Incorporar o asset vetorial/alta resolução da logo oficial obtida diretamente da tela `3101a950d99743ad80e51552d818b041` do projeto Stitch em `public/assets/images/logo-ibnp.png`.
  - Atualizar o componente Top App Bar (`views/layouts/app.blade.php`) e Footer Institucional para exibir a logo oficial da igreja no header e footer.
  - Adicionar favicon com a marca oficial no layout base (`views/layouts/app.blade.php`).
- **G2 (Link da Ação Social):**
  - Substituir todas as referências ao endereço antigo `https://escolasocialguapo.org.br` pelo domínio oficial da ação social: `https://social.ibnpguapo.org.br/` em `views/layouts/app.blade.php`, `views/pages/home.blade.php` e `views/pages/sobre.blade.php`.
- **G3 (Culto de Ensino de Quarta-feira):**
  - Atualizar `data/programacao/agenda.json`:
    - `id`: `culto-quarta-ensino`
    - `nome`: `"Culto de Ensino"`
    - `categoria`: `"Ensino Bíblico"`
    - `descricao`: `"Momento dedicado ao estudo sistemático da Palavra de Deus, exposição bíblica e edificação espiritual para toda a igreja."`
  - Atualizar os templates de apresentação (`views/pages/home.blade.php`, `views/pages/programacao.blade.php` e `views/layouts/app.blade.php`) para refletir o Culto de Ensino (sem menção a oração na quarta-feira).
  - Atualizar a suíte de testes de rotas, páginas e iCalendar (`tests/Feature/PageRoutesTest.php`, `tests/Feature/ProgramacaoRoutesTest.php`, `tests/Unit/ICalGeneratorTest.php`) para validar os novos contratos e textos.

### Non-Goals (Fora do Escopo)
- Alterar o Culto de Celebração da Família de Domingo (19:30).
- Modificar os contratos canônicos dos documentos legais Akoma Ntoso 3.0 (Estatuto e Regimento).
- Alterar a paleta cromática global Tailwind além da acomodação do asset oficial da logo.

---

## 2. Contratos & Modelagem

### 2.1 Schema de Dados da Agenda (`data/programacao/agenda.json`)
O item de quarta-feira no array `cultosRegulares` passa a obedecer ao contrato:
```json
{
  "id": "culto-quarta-ensino",
  "diaSemana": "quarta-feira",
  "horario": "19:30",
  "duracaoMinutos": 90,
  "nome": "Culto de Ensino",
  "categoria": "Ensino Bíblico",
  "local": "Templo Sede - Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro, Guapó - GO",
  "descricao": "Momento dedicado ao estudo sistemático da Palavra de Deus, exposição bíblica e edificação espiritual para toda a igreja.",
  "transmissaoAoVivo": false,
  "rrule": "FREQ=WEEKLY;BYDAY=WE"
}
```

### 2.2 Contrato do iCalendar RFC 5545 (`/programacao.ics`)
- **UID:** `UID:culto-quarta-ensino@ibnpguapo.org.br`
- **SUMMARY:** `SUMMARY:Culto de Ensino - IBN da Paz de Guapó`
- **DESCRIPTION:** `DESCRIPTION:Momento dedicado ao estudo sistemático da Palavra de Deus, exposição bíblica e edificação espiritual para toda a igreja.`
- **RRULE:** `RRULE:FREQ=WEEKLY;BYDAY=WE`
- **DTSTART / DTEND:** `193000` / `210000` (90 min)

### 2.3 Contrato de Links de Ação Social
- URL Canônica da Ação Social: `https://social.ibnpguapo.org.br/`
- Parâmetros: `target="_blank" rel="noopener noreferrer"`

### 2.4 Contrato da Identidade Visual (Logo)
- Arquivo público: `/assets/images/logo-ibnp.png`
- Alt text acessível: `"Logo IBN da Paz de Guapó"`
- Favicon: `<link rel="icon" type="image/png" href="/assets/images/logo-ibnp.png">`
- Header Container: Altura contida, proporção preservada, cantos arredondados, transição suave no hover.

---

## 3. Casos de Borda & Falhas (Edge Cases)

1. **Retrocompatibilidade de links antigos:** Se houver acessos a `/programacao.ics`, o gerador deve emitir o novo UID `culto-quarta-ensino@ibnpguapo.org.br` de forma idempotente sem corromper calendários pré-existentes.
2. **Carregamento de Imagem da Logo:** Para navegadores sem suporte a imagens ou conexões lentas, garantir texto alternativo (`alt="Logo IBN da Paz de Guapó"`) e dimensões fixas (evitando Layout Shift / CLS).
3. **Validação estrita do JSON Schema:** O arquivo `agenda.json` com `id: culto-quarta-ensino` deve continuar passando 100% no `AgendaSchemaValidationTest`.
4. **Tratamento de trailing slash em URL:** Todas as ocorrências do link de ação social devem utilizar rigorosamente `https://social.ibnpguapo.org.br/`.

---

## 4. Critérios de Aceitação & Plano de Verificação TDD

### Checklist de Aceitação
- [ ] 1. Asset `public/assets/images/logo-ibnp.png` presente e íntegro (proveniente da tela Stitch `3101a950d99743ad80e51552d818b041`).
- [ ] 2. Layout base (`views/layouts/app.blade.php`) exibe o `<img>` da logo oficial no cabeçalho e rodapé, além do favicon.
- [ ] 3. Todas as rotas de páginas (`/`, `/sobre`, `/contato`, `/programacao`, `/estatuto`, `/regimento`) renderizam a nova logo e o link `https://social.ibnpguapo.org.br/`.
- [ ] 4. O culto de quarta-feira em `data/programacao/agenda.json`, `/`, `/programacao` e no feed `.ics` denomina-se exclusivamente **Culto de Ensino**, com categoria **Ensino Bíblico** e sem termos alusivos a oração coletiva.
- [ ] 5. Zero ocorrências residuais de `https://escolasocialguapo.org.br` no código-fonte de views e testes.
- [ ] 6. 100% dos testes PHPUnit passam com sucesso no test runner (`./vendor/bin/phpunit`).

### Ciclo TDD
1. **Fase RED:** Atualizar os testes unitários e funcionais (`PageRoutesTest`, `ProgramacaoRoutesTest`, `ICalGeneratorTest`) para assertar os novos requisitos (logo, `social.ibnpguapo.org.br`, `Culto de Ensino`). Executar `./vendor/bin/phpunit` e confirmar falhas esperadas.
2. **Fase GREEN:** Atualizar `agenda.json`, `views/layouts/app.blade.php`, `views/pages/home.blade.php`, `views/pages/sobre.blade.php` e `README.md`.
3. **Validação:** Executar `./vendor/bin/phpunit` e confirmar 100% verde.
