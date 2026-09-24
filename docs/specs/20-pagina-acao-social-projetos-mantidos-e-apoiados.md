# Especificação Técnica 20: Página de Ação Social — Projetos Mantidos e Apoiados (Guapó e Angola)

## 1. Objetivo & Escopo

### Problema
Atualmente, o item de menu "Ação Social" no cabeçalho e rodapé direciona o usuário para um link externo (`https://social.ibnpguapo.org.br/`), tratando a iniciativa como um redirecionamento de saída. Além disso, a IBNP atua com duas frentes cruciais de impacto social e educacional que precisam ser formalmente apresentadas dentro do portal institucional da igreja:
1. **Escola Infantil de Guapó (Guapó-GO):** Projeto local no qual a IBNP atua diretamente como **mantenedora**.
2. **Escola Nova Esperança (Angola):** Projeto social e educacional internacional no qual a IBNP atua ativamente como **apoiadora**, destinando **ofertas mensais regulares** para sustento e avanço da iniciativa.

Como as páginas individuais e aprofundadas dos dois projetos ainda estão em fase de elaboração e refinamento, não devem ser incluídos links de redirecionamento quebrados ou para sites externos em construção. A navegação do site deve apresentar uma página própria, rica e informativa em `/acao-social`, consolidando os projetos que mantemos e apoiamos.

### Goals (Dentro do Escopo)
1. **Nova Rota Interna (`/acao-social`):**
   - Registrar a rota HTTP canônica `GET /acao-social` em `public/index.php`.
   - Adicionar o método `acaoSocial(): void` no controller institucional `App\Controllers\PageController`.
   - Criar a view Blade dedicada `views/pages/acao-social.blade.php`, estendendo o layout principal `views/layouts/app.blade.php`.
2. **Reestruturação da Navegação Global (`views/layouts/app.blade.php`):**
   - Converter o link "Ação Social" da barra de navegação desktop de link externo (`open_in_new`) para rota interna `/acao-social`, com marcação ativa de menu `currentRoute === '/acao-social'`.
   - Atualizar a gaveta de navegação móvel (*mobile drawer*) para apontar para `/acao-social`.
   - Atualizar os links rápidos do rodapé (Desktop e Mobile) de `https://social.ibnpguapo.org.br/` para `/acao-social`.
3. **Apresentação Clara dos Projetos na Página `/acao-social`:**
   - **Hero da Página:** Visão e teologia prática de ação social e transformação comunitária da IBNP ("Fé expressa em obras e acolhimento às próximas gerações").
   - **Card/Seção 1 — Mantenedores: Escola Social Infantil de Guapó (Guapó-GO):**
     - Papel: **Mantenedora Integral** (Fundação, gestão comunitária e suporte contínuo da IBNP).
     - Atuação: Educação infantil, contraturno escolar, reforço nutricional, formação de caráter e valores cristãos, acolhimento de famílias em vulnerabilidade em Guapó-GO.
     - Indicador informativo: Página detalhada da iniciativa em desenvolvimento.
   - **Card/Seção 2 — Apoiadores: Escola Nova Esperança (Angola):**
     - Papel: **Apoiadora Missionária & Social** (Ofertas e suporte financeiro mensal regular).
     - Atuação: Promoção do acesso à alfabetização, educação básica e dignidade para crianças e comunidades em Angola, em parceria missionária contínua.
     - Indicador informativo: Página detalhada da iniciativa em desenvolvimento.
   - **Engajamento e Transparência (Como Participar):**
     - Informações transparentes para contribuição voluntária via PIX da igreja (destinação para missões e ação social).
     - Canal direto de contato via WhatsApp para voluntariado ou envio de mantimentos/doações.
4. **Adequação de Links Internos nas Páginas Existentes:**
   - Atualizar os CTAs e links nas páginas `views/pages/home.blade.php` e `views/pages/sobre.blade.php` que apontavam para `https://social.ibnpguapo.org.br/`, redirecionando-os para a página interna `/acao-social`.
5. **Garantia de Qualidade e Conformidade Ad Grants / WCAG:**
   - Nenhuma menção a "em obras" ou "site em construção" (termos vetados pelas diretrizes do Google Ad Grants). Uso de termos positivos como "Iniciativa ativa mantida pela IBNP" e "Página detalhada em elaboração".
   - Atender aos padrões de contraste, landmarks semânticos e navegabilidade WCAG 2.1 AA.
   - Atualizar a suíte de testes do PHPUnit (`PageRoutesTest`, `HttpRoutesTest`, `AccessibilityWcagTest`).

### Non-Goals (Fora do Escopo)
- Não criar páginas individuais externas ou subdomínios neste momento (as páginas individuais dos projetos estão em preparação).
- Não alterar as credenciais nem os parâmetros da tag consolidada do Google (`gtag.js` - GA4 e Google Ads).
- Não alterar os textos canônicos do Estatuto Social e Regimento Interno.

---

## 2. Contratos & Modelagem

### 2.1 Roteamento HTTP (`public/index.php`)
```php
// Rota 8: Ação Social & Projetos Mantidos/Apoiados
$router->get('/acao-social', function () use ($pageController): void {
    $pageController->acaoSocial();
});
```

### 2.2 Controller de Páginas (`src/Controllers/PageController.php`)
```php
/**
 * Página de Ação Social: projetos mantidos (Guapó) e apoiados (Angola)
 */
public function acaoSocial(): void
{
    header('Content-Type: text/html; charset=utf-8');
    echo $this->renderer->render('pages.acao-social', [
        'currentRoute' => '/acao-social',
    ]);
}
```

### 2.3 Estrutura da View (`views/pages/acao-social.blade.php`)
- **Herança:** `@extends('layouts.app')`
- **Seções Blade:**
  - `@section('title', 'Ação Social & Projetos Comunitários | IBNP')`
  - `@section('meta_description', 'Conheça os projetos sociais mantidos e apoiados pela IBNP: Escola Infantil em Guapó-GO e Escola Nova Esperança em Angola.')`
  - `@section('content')`:
    - **Header/Hero Section:** Título H1, subtítulo institucional e pill badges de atuação ("Guapó-GO" e "Angola").
    - **Grade de Projetos (`grid md:grid-cols-2`):**
      - **Card Projeto 1:**
        - Badge: `MANTENEDORES` (estilo destaque primário/secundário).
        - Título: `Escola Infantil em Guapó`.
        - Localização: `Guapó, Goiás - Brasil`.
        - Descrição: Atendimento a crianças da comunidade local, suporte educacional e socioemocional.
        - Status informativo: Sem botão de saída externo, com aviso discreto de página individual em preparação.
      - **Card Projeto 2:**
        - Badge: `APOIADORES REGULARES` (estilo destaque de parceria/missões).
        - Título: `Escola Nova Esperança`.
        - Localização: `Angola - África`.
        - Descrição: Apoio através de ofertas mensais regulares para manutenção e educação infantil transcultural.
        - Status informativo: Sem botão de saída externo, com aviso discreto de página individual em preparação.
    - **Seção de Envolvimento e Contribuição:**
      - Chave PIX oficial da igreja para apoio específico a Ação Social & Missões.
      - CTA de WhatsApp com mensagem pré-configurada para voluntariado e parcerias.

---

## 3. Casos de Borda & Falhas (Edge Cases)

1. **Destacar Rota Ativa no Menu:**
   - Quando `$currentRoute === '/acao-social'`, os links de desktop e mobile devem receber a classe de item ativo (`text-primary font-bold bg-surface-cream-warm shadow-xs`).
2. **Remoção de Outbound Links:**
   - Garantir que nenhum link `target="_blank"` para `https://social.ibnpguapo.org.br/` permaneça na navegação global, evitando redirecionamento para URLs externas inacabadas.
3. **Preservação de Políticas do Ad Grants:**
   - O aviso de que as páginas individuais estão em desenvolvimento não pode usar termos depreciados como "em obras", "sob construção" ou "site incompleto".
4. **Semântica HTML e Acessibilidade:**
   - Manter hierarquia correta de headings (`<h1>` para o título principal da página, `<h2>` para os projetos e seções).
   - Uso de tags semânticas `<article>`, `<section>`, badges com contraste AA e ícones com `aria-hidden="true"`.

---

## 4. Critérios de Aceitação & Plano de Verificação (Checklist TDD)

- [ ] **1. Testes Automatizados (Fase RED):**
  - Adicionar teste `testAcaoSocialRouteRendersSuccessfully` em `tests/Feature/PageRoutesTest.php`:
    - Verifica status de resposta HTTP/renderização não vazia.
    - Verifica presença de "Ação Social", "Escola Infantil em Guapó", "Escola Nova Esperança", "Angola", "Mantenedores", "Apoiadores" e "ofertas mensais".
    - Verifica ausência de links externos obsoletos com `target="_blank"` para `https://social.ibnpguapo.org.br/`.
  - Atualizar asserções de navegação do layout em `tests/Feature/PageRoutesTest.php` e `HttpRoutesTest.php` para validar o link interno `/acao-social`.
- [ ] **2. Implementação do Código (Fase GREEN):**
  - Implementar método `acaoSocial()` no `PageController`.
  - Registrar rota `/acao-social` no `public/index.php`.
  - Criar `views/pages/acao-social.blade.php` com o design system existente (Tailwind, Material Symbols, paleta cream/earth).
  - Atualizar links de navegação em `views/layouts/app.blade.php`, `views/pages/home.blade.php` e `views/pages/sobre.blade.php`.
- [ ] **3. Validação de Regressão e Acessibilidade:**
  - Executar `./vendor/bin/phpunit` e garantir 100% de sucesso.
  - Verificar cumprimento das diretrizes de acessibilidade WCAG.
