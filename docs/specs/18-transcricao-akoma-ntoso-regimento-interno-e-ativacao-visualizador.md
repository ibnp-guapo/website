# [WDLC-F4] Especificação Técnica: Transcrição e Estruturação do Regimento Interno em Akoma Ntoso 3.0 XML e Ativação do Visualizador Interativo

> **Identificador:** SPEC-WDLC-F4-REGIMENTO  
> **Status:** Proposto para Aprovação  
> **Referência:** Issue / Tarefa de Transcrição Regimental Oficial  
> **Fonte Primária Documental:** `C:\Users\fboli\Downloads\Regimento Interno rev.1.pdf` (cópia em `data/legal/Regimento-Interno-IBNP.pdf`)  
> **Arquivo XML Alvo:** [`data/legal/regimento-interno.akn.xml`](../../data/legal/regimento-interno.akn.xml)  
> **Dependências:** [SPEC-WDLC-F1](01-arquitetura-informacao-requisitos.md), [SPEC-WDLC-F3](03-estatuto-social-akoma-ntoso.md), [SPEC-WDLC-F7](07-parser-visualizador-akoma-ntoso.md)  
> **Organização:** [ibnp-guapo](https://github.com/ibnp-guapo) / [website](https://github.com/ibnp-guapo/website)  
> **Data:** 2026-09-23  

---

## 1. Objetivo & Escopo

### 1.1 Objetivo
Transcrever integralmente o documento primário oficial do **Regimento Interno** da Igreja Batista Nacional da Paz de Guapó (revisão aprovada em **11 de janeiro de 2026**) para o formato semântico padronizado **OASIS LegalDocML Akoma Ntoso 3.0 XML** (`data/legal/regimento-interno.akn.xml`), ativando automaticamente o visualizador interativo em `/regimento` com busca textual, sumário geral responsivo, permalinks e download de XML.

### 1.2 Escopo (*Goals*)
1. **Cópia do Documento Fonte:** Copiar `Regimento Interno rev.1.pdf` para `data/legal/Regimento-Interno-IBNP.pdf`.
2. **Modelagem Semântica Akoma Ntoso 3.0:**
   - Criar `data/legal/regimento-interno.akn.xml` cobrindo rigorosamente a íntegra dos **8 Capítulos** e **29 Artigos**, com seus respectivos parágrafos, incisos e alíneas.
   - Metadados FRBR completos: identificação de obra, expressão e manifestação; referências às entidades (`#ibnp`, `#cbn`, `#ormibanGo`, `#assembleiaGeral`), signatários (`#deusimarPereiraAmaral`, `#fabriciaPaulaMoura`, `#suelySilvaAmaral`, `#fabioOliveiraNascimento`, `#welingtonCoelhoSouza`) e data de aprovação (`2026-01-11`).
3. **Ajuste Fino da View Blade:**
   - Atualizar `views/pages/legal/regimento.blade.php` para refletir os metadados do documento: insígnia *"Assembleia Geral Extraordinária • 11/01/2026"* (substituindo a menção residual de cartório da view modelo).
4. **Ciclo TDD Mandatório:**
   - Implementar testes no `tests/LegalDocs/AkomaNtosoValidationTest.php` validando:
     - Validação estrita do XML contra o schema oficial OASIS `schemas/akomantoso30.xsd`.
     - Unicidade global de todos os atributos `eId`.
     - Contagem exata de 8 capítulos (`cap_1` a `cap_8`) e 29 artigos (`art_1` a `art_29`).
     - Conformidade da estrutura FRBR (`2026-01-11`, idioma `por`, URI canônica).
   - Atualizar testes funcionais em `tests/Feature/LegalDocRoutesTest.php` e `tests/Feature/HttpRoutesTest.php` validando o carregamento da página ativa (`doc !== null`), busca, permalinks e download `/regimento/xml`.

### 1.3 Fora do Escopo (*Non-Goals*)
- Alteração ou reinterpretação jurídica do texto aprovado em assembleia.
- Modificação na estrutura do Estatuto Social já registrado (`estatuto-social.akn.xml`).
- Criação de novas rotas no sistema além das já existentes (`/regimento` e `/regimento/xml`).

---

## 2. Contratos & Modelagem

### 2.1 Padrão Akoma Ntoso 3.0 (OASIS LegalDocML)
- **Namespace:** `http://docs.oasis-open.org/legaldocml/ns/akn/3.0`
- **Elemento Raiz:** `<akomaNtoso><act name="regimentoInterno">`
- **Prefix / Preface:**
  - `<docTitle>`: REGIMENTO INTERNO DA IGREJA BATISTA NACIONAL DA PAZ DE GUAPÓ
  - `<p class="registryNote">`: Aprovado em Sessão Extraordinária da Assembleia Geral em 11 de janeiro de 2026.
- **FRBR Metadata:**
  - `FRBRWork`: URI `/br/go/guapo/rel/regimento/ibnp/2026-01-11`, data `2026-01-11`, país `bra`.
  - `FRBRExpression`: URI `/br/go/guapo/rel/regimento/ibnp/2026-01-11/por@`, idioma `por`.
  - `FRBRManifestation`: URI `/br/go/guapo/rel/regimento/ibnp/2026-01-11/por@/main.akn.xml`, formato `application/akn+xml`.

### 2.2 Estrutura Capitular e Normativa

| Capítulo | Identificador | Artigos | Assunto Principal |
| :--- | :--- | :--- | :--- |
| **Capítulo I** | `cap_1` | Arts. 1º e 2º | Nome, Princípios e Identidade Denominacional (filiação à CBN e adoção do Manual Básico dos Batistas Nacionais). |
| **Capítulo II** | `cap_2` | Arts. 3º ao 9º | Atribuições dos Membros da Diretoria (Presidente, Vice-Presidente, 1º e 2º Secretários, 1º e 2º Tesoureiros, Diretor de Patrimônio). |
| **Capítulo III** | `cap_3` | Arts. 10 ao 17 | Membros: Recebimento, Requisitos, Direitos, Deveres, Medidas Disciplinares e Desligamento/Exclusão. |
| **Capítulo IV** | `cap_4` | Arts. 18 e 19 | Relações da Igreja com o Ministério (reconhecimento, apoio, sustento integral/honorários, previdência e pensão vitalícia aos 65 anos). |
| **Capítulo V** | `cap_5` | Art. 20 | Atribuições da Assembleia Geral Soberana (atos patrimoniais, rol de membros, eleições e homologações). |
| **Capítulo VI** | `cap_6` | Arts. 21 ao 23 | Corpo Diaconal: Membros, Número e Ofício (requisitos, consagração, demissão e atribuições assistenciais/materiais). |
| **Capítulo VII** | `cap_7` | Arts. 24 ao 26 | Cooperadores do Ministério (obreiros não ordenados, funções, formação interna e apoio teológico CBN). |
| **Capítulo VIII** | `cap_8` | Arts. 27 ao 29 | Disposições Gerais (quórum para reforma regimental, matérias omissas e vigência a partir de 11/01/2026). |

### 2.3 Convenção de Identificadores Semânticos (`eId`)
- Capítulos: `cap_{1..8}`
- Artigos: `art_{1..29}`
- Parágrafos: `art_{N}_par_{M}` (ou `art_{N}_par_unico`)
- Incisos / Cláusulas: `art_{N}_cla_{M}` ou `art_{N}_par_{M}_cla_{K}`
- Alíneas / Pontos: `art_{N}_point_{letra}`

---

## 3. Casos de Borda & Tratamento de Falhas (Edge Cases)

1. **Ausência do Arquivo XML:** Se `regimento-interno.akn.xml` for removido temporariamente, o `LegalDocController::regimento()` deve continuar funcionando sem quebrar, renderizando graciosamente a tela institucional de transição (`inProcess => true`).
2. **Validação contra o XSD:** O XML deve passar estritamente pela validação de esquema `DOMDocument::schemaValidate('schemas/akomantoso30.xsd')`. Tags não permitidas pelo padrão Akoma Ntoso 3.0 resultarão em falha no PHPUnit.
3. **Caracteres Especiais & Encodings:** Preservar a acentuação correta em UTF-8 (`á`, `é`, `í`, `ó`, `ú`, `ã`, `õ`, `ç`) conforme o documento oficial, sem resíduos de codificação corrompida.
4. **Unicidade de `eId`:** Nenhum identificador pode se repetir, garantindo o funcionamento determinístico dos permalinks e do mecanismo de destaque por fragmento (`#art_14`, `#art_22`, etc.).
5. **Nenhum Resultado na Busca:** O input de busca deve exibir mensagem clara caso o usuário filtre termos inexistentes, sem mascarar os elementos do DOM.

---

## 4. Critérios de Aceitação & Plano de Verificação (Checklist TDD)

- [ ] **Test-First Red:** Criar/ajustar os testes em `tests/LegalDocs/AkomaNtosoValidationTest.php` e `tests/Feature/LegalDocRoutesTest.php` exigindo a existência e conformidade de `data/legal/regimento-interno.akn.xml` (8 capítulos, 29 artigos, data `2026-01-11`, rota ativa). Executar os testes e constatar falha controlada (Red).
- [ ] **Cópia do PDF:** Copiar o PDF oficial para `data/legal/Regimento-Interno-IBNP.pdf`.
- [ ] **Geração do XML Akoma Ntoso:** Criar `data/legal/regimento-interno.akn.xml` com todo o texto do documento e metadados.
- [ ] **Ajuste Visual:** Ajustar o cabeçalho em `views/pages/legal/regimento.blade.php` para indicar *"Assembleia Geral Extraordinária • {{ $formattedDate }}"*.
- [ ] **Test-First Green:** Executar `./vendor/bin/phpunit`. Todos os testes devem passar (100% Green), incluindo a validação formal XSD e as rotas HTTP.
