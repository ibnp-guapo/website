# Especificação Técnica 19: Conformidade Google for Nonprofits / Ad Grants — Missão Institucional, Atividades e Serviços Evidentes

## 1. Objetivo & Escopo

### Contexto & Problema
A candidatura ao **Google for Nonprofits / Google Ad Grants** estabelece como critério eliminatório a obrigatoriedade de **Missão e Atividades Evidentes**:
> *"O site precisa indicar claramente a missão da organização sem fins lucrativos e descrever as atividades ou serviços dela. Os visitantes precisam entender facilmente o que a organização faz e a quem ela serve.*
> *Problemas comuns: a missão é vaga, está escondida no site ou totalmente ausente. É difícil para um novo visitante entender rapidamente o propósito da organização ou seu caráter beneficente.*
> *Ação: destaque sua missão, geralmente na página inicial ou em uma página 'Sobre nós'. Descreva claramente seus principais programas, serviços e impacto. Inclua o número de registro da organização sem fins lucrativos (EIN, CNPJ) e/ou um relatório anual."*

### Diagnóstico Técnico das Oportunidades de Melhoria
1. **Ausência de Bloco Explícito de Missão na Home:** Embora a página inicial apresente cabeçalhos acolhedores e iniciativas sociais, não há uma seção expressamente intitulada e destacada com a **Missão Institucional**, **Propósito Beneficente** e declaração explícita de **A Quem Servimos**.
2. **Caráter Beneficente e Registro (CNPJ) com Destaque Central:** O CNPJ (`02.930.019/0001-62`) está visível no rodapé e na página Sobre, mas deve ser apresentado com destaque visual no bloco de identificação e missão na Home e na página Sobre, associado à natureza jurídica sem fins lucrativos.
3. **Detalhamento Estruturado de Programas, Serviços e Público-Alvo na Página "Sobre Nós":** A página `/sobre` precisa destacar, em posição prioritária, a tríade **Missão, Visão e A Quem Servimos**, detalhando os 4 programas/serviços fundamentais (Paz Kids / Educação Infantil, Acolhimento & Suporte a Famílias, Ação Social Solidária e Centro Comunitário da Escola Social).
4. **Demonstrativo Anual de Atividades & Transparência Comunitária:** Ausência de um painel/relatório resumido de impacto e transparência de atividades (Relatório Anual de Atividades 2025/2026), permitindo que visitantes e avaliadores do Google comprovem a atuação contínua, governança voluntária e prestação de contas da entidade.

### Goals (Dentro do Escopo)
1. **Destaque da Missão e Propósito Beneficente na Homepage (`/`):**
   - Criar uma seção em destaque intitulada `"Nossa Missão & Propósito Social"`, contendo:
     - Badge institucional: `"Organização Sem Fins Lucrativos • CNPJ 02.930.019/0001-62 • Fundada em 1999 • Guapó-GO"`;
     - Declaração canônica e inequívoca da **Missão**;
     - Bloco **"O Que Fazemos e a Quem Servimos"** com o público-alvo claramente definido (crianças, jovens, famílias e comunidade em vulnerabilidade);
     - Resumo dos 4 eixos centrais de atuação com CTAs de aprofundamento.
2. **Seção de Missão, Visão, A Quem Servimos e Relatório de Atividades na Página "Sobre Nós" (`/sobre`):**
   - Inserir no topo da coluna principal da página `/sobre` um bloco estruturado com:
     - **Nossa Missão:** Propósito formal de acolhimento, desenvolvimento humano e assistência solidária;
     - **Nossa Visão:** Ser referência comunitária na promoção de dignidade humana, valores e proteção à infância;
     - **A Quem Servimos:** Especificação clara do público atendido em Guapó-GO;
     - **Painel de Atividades & Relatório Anual de Transparência:** Resumo consolidado de atividades regulares, governança voluntária, prestação de contas e link direto para os instrumentos constitutivos (Estatuto e Regimento).
3. **Reforço no Rodapé Global (`views/layouts/app.blade.php`):**
   - Atualizar a descrição da entidade na coluna institucional do rodapé, frisando a missão de acolhimento, educação infantil e suporte social a famílias sob o CNPJ 02.930.019/0001-62.
4. **Ciclo TDD Mandatório (SDD):**
   - Atualizar `tests/Feature/PageRoutesTest.php` com asserções estritas que comprovem a presença dos novos blocos de Missão, "A Quem Servimos", Programas & Serviços, CNPJ em destaque e Relatório Anual / Demonstrativo de Transparência.

### Non-Goals (Fora do Escopo)
- Não alterar as rotas canônicas e URLs existentes.
- Não alterar as normas do Estatuto Social e do Regimento Interno registradas em cartório.
- Não introduzir bibliotecas pesadas de terceiros ou frameworks JavaScript externos.

---

## 2. Contratos & Modelagem

### 2.1 Texto Canônico da Missão e Declaração Institucional
- **Missão:**  
  *"Nossa missão é acolher pessoas, fortalecer famílias e promover o desenvolvimento humano integral no município de Guapó-GO, por meio do ensino de valores éticos e cristãos, da educação e desenvolvimento infantil continuado e de ações solidárias de assistência comunitária a lares em situação de vulnerabilidade."*

- **A Quem Servimos (Público Beneficiário):**  
  *"Atendemos diretamente crianças de 0 a 11 anos, adolescentes, famílias de Guapó e região metropolitana, além de pessoas que necessitam de acolhimento humano, apoio emocional, fortalecimento de vínculos familiares e assistência comunitária emergencial."*

- **O Que Fazemos (Atividades e Serviços Principais):**  
  1. *Programa de Desenvolvimento Infantil (Paz Kids):* Atividades socioeducativas, lúdicas e morais para crianças durante os encontros comunitários;
  2. *Acolhimento Familiar & Atendimento Pastoral Gratuito:* Mentoria, suporte relacional e orientação emocional para famílias e cidadãos de Guapó;
  3. *Ação Social Comunitária Solidária:* Arrecadação e distribuição de mantimentos, vestuário e apoio a famílias em vulnerabilidade social;
  4. *Iniciativa Mantenedora da Escola Social de Guapó:* Projeto socioeducativo de contraturno escolar e centro comunitário multiuso;
  5. *Iniciativa Cultural & Musical:* Oficinas de canto, instrumentos musicais e apresentações que estimulam talentos artísticos locais.

- **Demonstrativo Anual de Transparência & Governança (Relatório Anual de Atividades):**  
  - CNPJ: `02.930.019/0001-62`
  - Natureza Jurídica: `322-0 - Organização Religiosa Sem Fins Lucrativos`
  - Fundação: `14 de janeiro de 1999`
  - Governança: Diretoria estatutária e conselho fiscal voluntários, sem distribuição de lucros ou dividendos
  - Relatório de Atividades: Resumo público de encontros comunitários regulares (quartas e domingos), atendimentos pastorais, projetos infantis e campanhas de arrecadação solidária.

---

## 3. Casos de Borda & Falhas (Edge Cases)

| Cenário de Borda | Risco / Problema | Tratamento na Implementação |
| :--- | :--- | :--- |
| **Visitante acessa apenas a Home** | Não navegar até a página Sobre e não identificar a missão | A missão, o público atendido e o CNPJ estão expressamente destacados no primeiro terço da Home. |
| **Avaliador do Google busca número de registro (EIN/CNPJ)** | Dificuldade de encontrar o CNPJ em texto corrido | Badges em alto contraste com o CNPJ `02.930.019/0001-62` tanto na Home, na página Sobre quanto no Rodapé. |
| **Avaliador busca "Relatório Anual" ou comprovação de atividades** | Alegação de que a entidade não demonstra histórico ou atividades ativas | Bloco dedicado de "Demonstrativo Anual de Atividades & Governança" com resumo das atividades executadas e documentos regulatórios. |
| **Acessibilidade e Dispositivos Móveis** | Textos longos prejudicarem a legibilidade em telas pequenas | Design responsivo com cards modulares, tipografia hierárquica e espaçamento em conformidade com WCAG 2.1 AA. |

---

## 4. Critérios de Aceitação & Plano de Verificação

### Critérios de Aceitação (Checklist Mensurável)
- [ ] A página inicial exibe a seção `"Nossa Missão & Propósito Social"` com a declaração explícita da missão da organização sem fins lucrativos.
- [ ] A página inicial exibe com destaque o bloco `"A Quem Servimos"`, especificando o público atendido (famílias, crianças de 0 a 11 anos e comunidade em vulnerabilidade).
- [ ] A página inicial exibe com clareza os eixos de atividades e serviços oferecidos.
- [ ] O badge com o CNPJ `02.930.019/0001-62` e a identificação `"Organização Sem Fins Lucrativos"` estão visíveis no topo da seção de missão da Home.
- [ ] A página `/sobre` exibe a seção prioritária `"Missão, Visão e A Quem Servimos"`.
- [ ] A página `/sobre` exibe o bloco de `"Demonstrativo Anual de Atividades & Transparência"` com resumo de impacto, serviços e governança sem fins lucrativos.
- [ ] O rodapé de todas as páginas reforça a missão e a natureza sem fins lucrativos da entidade mantenedora.
- [ ] 100% dos testes da suíte PHPUnit (`vendor/bin/phpunit`) passam com sucesso.
- [ ] O teste de acessibilidade (`npm run test:a11y`) conclui sem violações.
