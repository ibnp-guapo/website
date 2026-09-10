# Especificação Técnica: Parser e Visualizador Web de Textos Legais Akoma Ntoso 3.0 em PHP

- **Identificador:** `SPEC-WDLC-F4-07`
- **Fase do WDLC:** F4 - Desenvolvimento em PHP / Legal-Tech
- **Issue Relacionada:** [#7](https://github.com/ibnp-guapo/website/issues/7)
- **Status:** Aprovado e Implementado
- **Data:** 10/09/2026

---

## 1. Objetivo & Escopo

### 1.1 Objetivo
Disponibilizar os documentos de governança da **Igreja Batista Nacional da Paz de Guapó** (Estatuto Social e Regimento Interno) através de um parser semântico e visualizador web de alta fidelidade ao padrão **OASIS LegalDocML Akoma Ntoso 3.0**, permitindo consulta pública, leitura estruturada, pesquisa textual instantânea, navegação por permalinks e download dos arquivos XML originais.

### 1.2 Componentes Desenvolvidos
1. **Data Transfer Objects (`App\DTO`):**
   - `LegalDocumentDto`: Estrutura canônica agregando metadados FRBR, prefácio, capítulos, sumário (`toc`) e contagem de artigos.
   - `ChapterDto`: Estrutura de capítulo (`eId`, `num`, `heading`, `articles`).
   - `ArticleDto`: Estrutura de artigo (`eId`, `num`, `content`, `clauses`).
   - `ClauseDto`: Parágrafos (`§`), incisos e alíneas com `eId` fiéis.
   - `TOCItemDto`: Itens do sumário para navegação fluida.
2. **Serviço de Leitura (`App\Services\AkomaNtosoParser`):**
   - Processamento XML via extensões nativas `DOMDocument` e `DOMXPath`.
   - Mapeamento estrito do namespace `http://docs.oasis-open.org/legaldocml/ns/akn/3.0`.
   - Sistema de cache em disco (`storage/cache/`) com chave baseada em hash MD5 do caminho do arquivo e timestamp de modificação (`filemtime`).
3. **Controller Eclesiástico (`App\Controllers\LegalDocController`):**
   - Rota `/estatuto`: Leitor interativo do Estatuto Social averbado em 25/03/2002.
   - Rota `/estatuto/xml`: Download direto do arquivo `estatuto-social.akn.xml` com header `application/xml`.
   - Rota `/regimento`: Apresentação institucional com estado de transição acolhedor para a transcrição semântica (Issue #4).
   - Rota `/regimento/xml`: Endpoint para download quando o documento for publicado.
4. **Interface Web do Leitor Jurídico:**
   - Layout de 2 colunas responsivo e acessível (WCAG 2.1 AA).
   - Coluna de sumário dinâmico integrado (`sticky` em desktop).
   - Campo de busca em tempo real nos artigos com realce na cor `#EFA162`.
   - Botão para cópia do permalink direto de cada artigo (`#art_X`) com toast interativo.
   - Efeito `highlight-pulse` com animação suave ao navegar por âncoras.
   - Botões de ação rápida: download de XML e acionamento de impressão (`window.print()`).

---

## 2. Contratos e Rotas

| Método | Rota | Descrição | Content-Type |
| :--- | :--- | :--- | :--- |
| `GET` | `/estatuto` | Leitor web do Estatuto Social | `text/html; charset=utf-8` |
| `GET` | `/estatuto/xml` | Download do XML do Estatuto | `application/xml; charset=utf-8` |
| `GET` | `/regimento` | Leitor do Regimento ou Aviso | `text/html; charset=utf-8` |
| `GET` | `/regimento/xml` | Download do XML do Regimento | `application/xml; charset=utf-8` |

---

## 3. Cobertura de Testes Automatizados

A suíte de testes no PHPUnit 11 valida:
- **`Tests\Unit\AkomaNtosoParserTest`:**
  - Extração precisa dos 5 capítulos e 18 artigos do Estatuto Social.
  - Validação dos metadados FRBR (`ESTATUTO DA IGREJA BATISTA NACIONAL DA PAZ DE GUAPÓ`, `2002-03-25`).
  - Integridade da árvore de sumário (`TOCItemDto`).
  - Mecanismo de persistência e leitura de cache em `storage/cache/`.
  - Tratamento de exceções para arquivo inexistente e XML malformado.
- **`Tests\Feature\LegalDocRoutesTest`:**
  - Validação da renderização HTML do Estatuto Social e âncoras de artigos.
  - Validação do estado de transição para o Regimento Interno.
