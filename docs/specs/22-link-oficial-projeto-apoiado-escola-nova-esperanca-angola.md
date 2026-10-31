# Especificação Técnica 22: Link Oficial do Projeto Social Apoiado — Escola Nova Esperança (Angola)

## 1. Objetivo & Escopo

### Problema
Na especificação técnica 20 (`docs/specs/20-pagina-acao-social-projetos-mantidos-e-apoiados.md`), a página `/acao-social` consolidou os dois eixos de responsabilidade social e educacional da **Igreja Batista Nacional da Paz de Guapó (IBNP)**:
1. **Escola Infantil em Guapó-GO:** Projeto no qual a IBNP atua como fundadora e **mantenedora oficial**.
2. **Escola Nova Esperança (Angola • África):** Obra educacional e social transcultural na qual a IBNP atua como **apoiadora contínua**, destinando ofertas mensais regulares para manutenção de suas atividades.

No momento da implementação inicial da Spec 20, a página individual do projeto em Angola estava em desenvolvimento, motivo pelo qual foi inserido um informativo temporário:
> *"A página institucional detalhada do projeto está em fase de elaboração pela equipe missionária."*

Com o portal oficial da iniciativa plenamente ativo e acessível através de **`https://social.imne.ao/`**, a página `/acao-social` deve integrar o link externo oficial de forma segura, elegante e alinhada à identidade visual e aos padrões de acessibilidade e governança.

### Goals (Dentro do Escopo)
1. **Atualização da View (`views/pages/acao-social.blade.php`):**
   - No card da *Escola Nova Esperança*, substituir o aviso textual temporário por uma área de ação com:
     - Identificação institucional: `Iniciativa da IMNE (Missão Nova Esperança)` acompanhada de ícone semântico `public`.
     - Botão CTA: `Conhecer o Projeto` apontando diretamente para `https://social.imne.ao/`.
   - Garantir atributos de segurança e boas práticas para links externos (`target="_blank" rel="noopener noreferrer"`).
   - Inserir `title` e acessibilidade via leitor de telas indicando abertura em nova aba.
2. **Cobertura de Testes Automatizados (TDD):**
   - Atualizar `tests/Feature/PageRoutesTest.php` e `tests/Feature/HttpRoutesTest.php` para validar a presença da URL `https://social.imne.ao/`, dos atributos de segurança e dos textos institucionais.
3. **Conformidade com Google Ad Grants e WCAG 2.1 AA:**
   - Garantir contraste mínimo 4.5:1 para os textos e botões.
   - Preservar foco visível por teclado e ausência de mensagens depreciativas sobre construção ou obras.

### Non-Goals (Fora do Escopo)
- Não alterar a estrutura ou conteúdo do card da Escola Infantil em Guapó.
- Não alterar parâmetros de roteamento de servidor ou regras do Google Ads / GA4.
- Não modificar o Estatuto Social ou Regimento Interno.

---

## 2. Contratos & Modelagem

### 2.1 Marcação do Componente (`views/pages/acao-social.blade.php`)
```html
<!-- Acesso ao Portal Oficial do Projeto Social Apoiado -->
<div class="pt-6 border-t border-outline-variant/30 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div class="flex items-center gap-2 text-xs text-text-muted">
        <span class="material-symbols-outlined text-primary text-[18px]">public</span>
        <span>Iniciativa da <strong>IMNE</strong> (Missão Nova Esperança)</span>
    </div>
    <a href="https://social.imne.ao/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary text-on-primary text-xs font-bold shadow-sm hover:bg-secondary-container transition-all active:scale-95 whitespace-nowrap shrink-0" title="Visitar portal oficial da Escola Nova Esperança em Angola (abre em nova aba)">
        <span>Conhecer o Projeto</span>
        <span class="material-symbols-outlined text-[14px]">open_in_new</span>
    </a>
</div>
```

---

## 3. Casos de Borda & Falhas (Edge Cases)

1. **Abertura Segura de Links Externos (`target="_blank"`):**
   - O atributo `rel="noopener noreferrer"` é obrigatório para prevenir ataques de tabnabbing reverso e preservar a privacidade do usuário.
2. **Responsividade em Telas Pequenas (Mobile):**
   - O container usa `flex flex-col sm:flex-row`, permitindo que o texto e o botão se empilhem adequadamente em smartphones sem quebrar a largura do card.
3. **Acessibilidade para Leitores de Tela:**
   - O atributo `title` fornece a instrução explícita de que o link abrirá uma nova janela/aba.
4. **Resiliência do Test Suite:**
   - As asserções devem verificar tanto a presença do link completo `https://social.imne.ao/` quanto as diretrizes de segurança aplicadas.

---

## 4. Critérios de Aceitação & Plano de Verificação (Checklist TDD)

- [ ] **1. Fase RED:**
  - Atualizar `tests/Feature/PageRoutesTest.php` com asserções para `https://social.imne.ao/`, `target="_blank"`, `rel="noopener noreferrer"` e `Conhecer o Projeto`.
  - Atualizar `tests/Feature/HttpRoutesTest.php` com asserção para `https://social.imne.ao/`.
  - Executar os testes e confirmar a falha esperada (link ainda não presente na view).
- [ ] **2. Fase GREEN:**
  - Atualizar `views/pages/acao-social.blade.php` com o novo componente.
  - Executar a suíte de testes e confirmar aprovação de 100% dos testes.
- [ ] **3. Garantia de Regressão:**
  - Executar `composer test` completo para assegurar que nenhum outro teste foi impactado.

