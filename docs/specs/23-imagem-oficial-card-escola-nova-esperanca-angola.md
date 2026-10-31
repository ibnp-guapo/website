# Especificação Técnica 23: Imagem Oficial do Projeto Apoiado — Escola Nova Esperança (Angola)

## 1. Objetivo & Escopo

### Problema
O card da **Escola Nova Esperança (Angola)** na página `/acao-social` apresenta os detalhes institucionais, escopo de apoio da IBNP e o link para o portal oficial (`https://social.imne.ao/`), porém ainda carecia de registro fotográfico real das atividades e das crianças atendidas pela missão.
O envio da fotografia oficial (`IMG_20251111_083142.jpg.jpeg`) retrata os alunos uniformizados e a liderança do projeto em Angola. É necessário incorporar esta imagem no card do projeto em `/acao-social`, aplicando otimização para web, boas práticas de performance (Core Web Vitals) e acessibilidade WCAG 2.1 AA.

### Goals (Dentro do Escopo)
1. **Otimização e Processamento do Asset:**
   - Converter e redimensionar a foto original (2.49 MB) para um arquivo web-friendly (`public/assets/images/escola-nova-esperanca-angola.jpg`) com largura máx de 960px e compressão equilibrada (~100-150 KB).
2. **Atualização da View (`views/pages/acao-social.blade.php`):**
   - Inserir a imagem no topo do conteúdo do card da Escola Nova Esperança.
   - Garantir tags `width`, `height`, `loading="lazy"`, `decoding="async"` e `alt` descritivo.
   - Envolver a imagem em container responsivo com aspect ratio refinado (`aspect-[16/10] sm:aspect-[16/9]`), bordas arredondadas e sombra suave do design system.
3. **Acessibilidade & Qualidade (TDD):**
   - Atualizar a suíte de testes unitários/funcionais em `tests/Feature/PageRoutesTest.php`.
   - Validar conformidade com WCAG AA através do script `scripts/audit_accessibility.js`.

### Non-Goals (Fora do Escopo)
- Não alterar a seção de Guapó ou o Hero da página.
- Não carregar imagens desnecessárias que afetem a métrica LCP no mobile.

---

## 2. Contratos & Modelagem

### 2.1 Asset no Sistema de Arquivos
- **Caminho de Produção:** `public/assets/images/escola-nova-esperanca-angola.jpg`
- **Dimensões Alvo:** 960x720px (ou proporção natural aproximada com máx 960px de largura).
- **Formato:** JPEG com qualidade 82-85.

### 2.2 Estrutura Blade do Card (`views/pages/acao-social.blade.php`)
```html
<!-- Destaque Fotográfico: Missão em Campo -->
<figure class="rounded-2xl bg-surface-cream-warm/50 border border-outline-variant/40 mb-6 overflow-hidden">
    <a href="/assets/images/escola-nova-esperanca-angola.jpg" target="_blank" rel="noopener noreferrer" class="group relative block overflow-hidden aspect-[16/9]" title="Clique para ampliar a fotografia oficial">
        <img
            src="/assets/images/escola-nova-esperanca-angola.jpg"
            alt="Alunos uniformizados e liderança da Escola Nova Esperança em Angola"
            width="960"
            height="720"
            loading="lazy"
            decoding="async"
            class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300"
        />
        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white">
            <span class="material-symbols-outlined text-[28px]">zoom_in</span>
        </div>
    </a>
    <figcaption class="p-4 space-y-1">
        <span class="inline-flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider text-primary">
            <span class="material-symbols-outlined text-[14px]">photo_camera</span>
            <span>Missão em Campo • Angola</span>
        </span>
        <p class="text-xs sm:text-sm font-bold text-on-surface leading-snug">Alunos atendidos e liderança missionária</p>
        <p class="text-xs text-text-muted leading-relaxed">Crianças uniformizadas e liderança da Escola Nova Esperança. Clique na foto para ver em alta resolução.</p>
    </figcaption>
</figure>
```

---

## 3. Casos de Borda & Falhas (Edge Cases)

1. **Cumulative Layout Shift (CLS):**
   - Declarar explicitamente classes de aspect ratio (`aspect-[16/10] sm:aspect-[16/9]`) e atributos `width` e `height` na tag `<img>` para que o browser reserve o espaço exato antes do download.
2. **Acessibilidade Digital (WCAG 2.1 AA):**
   - O texto alternativo (`alt`) não deve ser genérico ("foto"), mas descrever fielmente os alunos uniformizados e a liderança da Escola Nova Esperança em Angola.
3. **Auditoria de Imagens do Layout:**
   - Todas as imagens do sistema devem possuir atributo `alt` não vazio, conforme validado por `scripts/audit_accessibility.js`.

---

## 4. Critérios de Aceitação & Plano de Verificação (Checklist TDD)

- [ ] **1. Fase RED:**
  - Adicionar asserção em `tests/Feature/PageRoutesTest.php` verificando a presença de `/assets/images/escola-nova-esperanca-angola.jpg` e o texto alternativo correspondente.
  - Executar os testes e confirmar a falha esperada.
- [ ] **2. Processamento do Asset:**
  - Processar e salvar `public/assets/images/escola-nova-esperanca-angola.jpg`.
- [ ] **3. Fase GREEN:**
  - Inserir a imagem na view `views/pages/acao-social.blade.php`.
  - Executar `composer test` e confirmar aprovação de 100% dos testes.
- [ ] **4. Auditoria de Acessibilidade:**
  - Executar `composer run test:a11y` e confirmar aprovação contínua dos landmarks e imagens.

