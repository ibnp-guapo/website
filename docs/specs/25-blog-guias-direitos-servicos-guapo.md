# Especificação Técnica 25: Blog da IBNP (guias de direitos e serviços em Guapó)

## 1. Objetivo & Escopo

### Problema
Muitas famílias atendidas pela IBNP dependem de benefícios sociais (Cadastro Único, Bolsa Família, Gás do Povo, Tarifa Social) e não sabem quem tem direito, que documento levar ou o que fazer para não perder o benefício. O Guia de Chegada cobre os primeiros passos de quem chega à cidade, mas não há espaço para guias mais longos e atualizáveis.

### Goals (Dentro do Escopo)
1. **Rotas:** `GET /blog` (lista) e `GET /blog/{slug}` (post), com `BlogController` e views `views/pages/blog/index.blade.php` e `views/pages/blog/post.blade.php`.
2. **Conteúdo em Markdown** em `data/blog/<slug>.md`, com front matter YAML. O nome do arquivo é o slug (`[a-z0-9-]`). Escrever um post novo não exige mexer em código.
3. **Publicação agendada:** posts com `data` no futuro não aparecem na lista nem abrem pela URL até o dia (fuso America/Sao_Paulo).
4. **SEO:** título e descrição por post, canonical, `og:type=article`, `article:published_time`/`modified_time` e JSON-LD `BlogPosting`. Lista e posts no `public/sitemap.xml`.
5. **Navegação:** link na gaveta móvel e nos links rápidos do rodapé. O menu desktop está no limite de largura em `xl` (ver Spec 24) e não recebe item novo.
6. **Testes:** `tests/Unit/BlogServiceTest.php` e `tests/Feature/BlogRoutesTest.php`.

### Non-Goals (Fora do Escopo)
- Comentários, busca, paginação, feed RSS e páginas por tag (entram quando houver volume de posts).
- Painel de edição: os posts são editados no repositório, como o resto do conteúdo.

## 2. Formato do post

```markdown
---
titulo: "Título do post"                  # obrigatório; vira <h1> e <title>
resumo: "Até ~160 caracteres."            # obrigatório; meta description e chamada na lista
data: 2026-11-14                          # obrigatório; data de publicação
atualizado: 2026-11-14                    # opcional; exibido quando posterior à data
categoria: Direitos e benefícios          # opcional (padrão "Blog")
tags: [Cadastro Único, CRAS]              # opcional; vira keywords no JSON-LD
serie: "Direitos e benefícios em Guapó (1 de 3)"  # opcional; ordena posts do mesmo dia
---

Corpo em Markdown (CommonMark + tabelas).
```

Regras de segurança da renderização (`league/commonmark`):
- `html_input: escape`: HTML cru no Markdown aparece como texto, nunca é executado.
- `allow_unsafe_links: false`: links `javascript:`, `data:` etc. são removidos.
- Tabelas saem dentro de `<div class="artigo-tabela">`, com rolagem horizontal no celular.

A tipografia do conteúdo fica na classe `.artigo` em `public/assets/css/input.css` (lembrar de rodar `npm run build:css`).

## 3. Conteúdo e linguagem
- Linguagem simples, para famílias, não para técnicos. Deixar claro que a IBNP não é órgão do governo.
- Endereços e telefones de órgãos de Guapó só com fonte oficial (os mesmos do Guia de Chegada, Spec 24).
- Valores e regras de benefícios mudam: todo post termina com a data em que as informações foram conferidas e orienta a confirmar no CRAS ou nos canais oficiais.
- Vocabulário Ad Grants (Spec 15/17): "encontros", sem termos de obra ou construção.

## 4. Primeira série (14/11/2026)
1. `cadastro-unico-em-guapo`: o que é o Cadastro Único, quem pode, documentos e onde fazer.
2. `bolsa-familia-quem-tem-direito`: regras, valores do reajuste de outubro de 2026 (piso de R$ 691), condicionalidades e Regra de Proteção.
3. `cadastro-unico-desatualizado`: benefícios que dependem do cadastro em dia, quando atualizar e revisão cadastral.
