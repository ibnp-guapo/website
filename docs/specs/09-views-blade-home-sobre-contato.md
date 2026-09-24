# Especificação Técnica: Desenvolvimento das Views PHP/Blade da Home, Sobre e Contato

- **Identificador:** `SPEC-WDLC-F4-09`
- **Fase do WDLC:** F4 - Desenvolvimento em PHP / Frontend
- **Issue Relacionada:** [#9](https://github.com/ibnp-guapo/website/issues/9)
- **Status:** Aprovado e Implementado
- **Data:** 10/09/2026

---

## 1. Objetivo & Escopo

### 1.1 Objetivo
Implementar as páginas institucionais **Home (`/`)**, **Sobre Nós (`/sobre`)**, **Contato & Localização (`/contato`)** e **Página de Erro 404** utilizando o motor de templates **Blade**, com layout mestre unificado, tipografia harmoniosa (`Inter` e `Merriweather`) e componentes visuais baseados nos mockups e Design System do **Stitch MCP** (`projects/6725281104397729478`).

### 1.2 Regras Institucionais & Litúrgicas
- **Identidade:** Igreja Batista Nacional da Paz de Guapó (IBNP Guapó), fundada em 14/01/1999, filiada à Convenção Batista Nacional (CBN) e ORMIBAN Goiás, CNPJ `02.930.019/0001-62`.
- **Endereço Sede:** Rua Presidente Kennedy, Qd. 21, Lt. 13 – Centro, Guapó – GO, CEP 75350-000.
- **Grade Canônica:**
  - **Quarta-feira das 19:30 às 21:00 (90 min):** Culto de Oração e Estudo Bíblico.
  - **Domingo das 19:30 às 21:00 (90 min):** Culto de Celebração da Família.
  - *Cultos 100% presenciais (sem transmissão ao vivo e sem reuniões aos sábados).*
- **Canais:** Telefone/WhatsApp `(62) 99870-0089` (`+55 62 99870-0089`), Instagram `@ibnp_guapo`, YouTube `@ibnpguapo`.

---

## 2. Componentes Desenvolvidos

1. **Serviço de Renderização Blade (`App\Services\BladeViewRenderer`):**
   - Integração desacoplada de `Illuminate\View\Compilers\BladeCompiler`, `Illuminate\View\Factory` e `Illuminate\View\FileViewFinder`.
   - Compilação dos templates em `views/` com armazenamento em cache em `storage/cache/views`.
2. **Controller de Páginas (`App\Controllers\PageController`):**
   - `home()`: Renderiza a página principal integrando cultos semanais, governança aberta e localização.
   - `sobre()`: Renderiza história desde 1999, Confissão de Fé da CBN e dados eclesiásticos.
   - `contato()`: Renderiza canais oficiais, endereço da sede em Guapó e mapa interativo embed.
   - `notFound()`: Renderiza página 404 personalizada com status HTTP 404.
3. **Templates Blade:**
   - `views/layouts/app.blade.php`: Layout base com Header responsivo (menu mobile toggle e botão WhatsApp em `#F43517`), slot principal `@yield('content')` e Footer completo.
   - `views/pages/home.blade.php`: Hero acolhedor, widget "Cultos da Semana", cartões de Transparência Akoma Ntoso e mapa.
   - `views/pages/sobre.blade.php`: Fundação em 1999, Declaração de Fé da CBN e filiação à ORMIBAN Goiás.
   - `views/pages/contato.blade.php`: Endereço, mapa do Google Maps, link WhatsApp wa.me e redes sociais.
   - `views/pages/404.blade.php`: Página de erro acolhedora e informativa.

---

## 3. Cobertura de Testes Automatizados (PHPUnit 11)

A classe `Tests\Feature\PageRoutesTest` valida:
- `testHomeRendersBladeViewWithEssentialSections`: Valida seções de Hero, Cultos, Governança Akoma Ntoso e link wa.me.
- `testSobreRendersHistoryAndCbnAffiliation`: Valida fundação em 1999, filiação à CBN e CNPJ da congregação.
- `testContatoRendersLocationAndChannels`: Valida endereço no Centro de Guapó, WhatsApp `(62) 99870-0089`, redes sociais e iframe do mapa.
