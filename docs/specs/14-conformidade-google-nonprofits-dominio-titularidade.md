# Especificação Técnica 14: Conformidade Google for Nonprofits e Comprovação de Titularidade do Domínio

## 1. Objetivo & Escopo

### Problema
A candidatura ao **Google Workspace para Organizações Sem Fins Lucrativos** para o domínio `ibnpguapo.org.br` foi recusada pela equipe de conformidade do Google com o motivo:
> *"não conseguimos confirmar sua relação com a sua organização sem fins lucrativos registrada. Para prosseguirmos, precisamos da confirmação de que a Igreja Batista Nacional da Paz de Guapo realmente detém e opera este domínio. Problema identificado: **Site com modelo**."*

### Diagnóstico Técnico das Causas
1. **Ausência de Declaração Explícita de Titularidade do Domínio:** O site exibe o CNPJ e nome abreviado no rodapé, mas não possui a declaração formal exigida pelo Google atestando que a entidade registrada opera e detém a titularidade do domínio `ibnpguapo.org.br`.
2. **Indícios de "Site com Modelo / Em Construção":** A rota `/regimento` exibe badges com `"Documento em Transcrição Semântica"` e citação textual a `"Issue #4"`. Para analistas do Google, badges de pendência técnica e referências a issues de GitHub qualificam o site como *template incompleto ou rascunho de desenvolvimento*.
3. **Ausência de E-mail Institucional Oficial:** As páginas `/contato`, `/sobre` e rodapé listam apenas WhatsApp e redes sociais, sem um e-mail institucional oficial (`contato@ibnpguapo.org.br`). O Google avalia canais de comunicação formais da organização.
4. **Ficha Cadastral e Jurídica na Página "Sobre":** Falta uma seção estruturada de transparência com os dados oficiais da Receita Federal (Razão Social, CNPJ, Data de Fundação, Natureza Jurídica 322-0, Endereço Sede Completo e Declaração de Titularidade do Domínio).

### Goals (Dentro do Escopo)
- Inserir declaração inequívoca e padronizada de titularidade do domínio `ibnpguapo.org.br` no rodapé de todas as páginas (`views/layouts/app.blade.php`), na página Sobre (`views/pages/sobre.blade.php`) e na página de Contato (`views/pages/contato.blade.php`).
- Exibir a **Ficha Institucional e Cadastral Oficial** na página `/sobre` com Razão Social completa, CNPJ, Natureza Jurídica, Endereço da Sede, Data de Fundação e Domínio Titular.
- Substituir a tela de pendência provisória de `/regimento` por uma página institucional formal e definitiva do Regimento Interno, com certidão de regência, princípios disciplinares e diretrizes regimentais em vigor, eliminando qualquer texto de rascunho ou menção a "Issue #4" / "transcrição".
- Adicionar e-mail institucional (`contato@ibnpguapo.org.br`) nos canais de contato (`agenda.json`, `agenda.schema.json`, `/contato`, `/sobre` e rodapé).
- Atualizar a suíte de testes automatizados (`PageRoutesTest`, `LegalDocRoutesTest`, `ICalGeneratorTest`) para validar todos os novos contratos e textos de conformidade.

### Non-Goals (Fora do Escopo)
- Alterar o sistema de roteamento ou autenticação.
- Alterar a estrutura canônica XML do Estatuto Social já aprovada em cartório.
- Modificar serviços de terceiros além das diretrizes exigidas pelo Google for Nonprofits.

---

## 2. Contratos & Modelagem

### 2.1 Schema de Dados (`data/programacao/agenda.schema.json`)
Adicionar propriedade opcional/recomendada `email` no objeto `canais`:
```json
"canais": {
  "type": "object",
  "required": ["telefone", "whatsapp", "instagram"],
  "properties": {
    "telefone": { "type": "string" },
    "whatsapp": { "type": "string", "format": "uri" },
    "instagram": { "type": "string", "format": "uri" },
    "youtube": { "type": "string", "format": "uri" },
    "email": { "type": "string", "format": "email" }
  }
}
```

### 2.2 Dados Oficiais da Organização (`data/programacao/agenda.json`)
```json
"canais": {
  "telefone": "(62) 99870-0089",
  "whatsapp": "https://wa.me/5562998700089",
  "email": "contato@ibnpguapo.org.br",
  "instagram": "https://instagram.com/ibnp_guapo",
  "youtube": "https://youtube.com/@ibnpguapo"
}
```

### 2.3 Declaração de Titularidade do Domínio (Texto Canônico)
Texto a ser inserido no rodapé global (`views/layouts/app.blade.php`), página Sobre (`/sobre`) e Contato (`/contato`):
> *"O domínio **ibnpguapo.org.br** e este website oficial são de propriedade, mantidos e operados exclusivamente pela **Igreja Batista Nacional da Paz de Guapó**, pessoa jurídica de direito privado sem fins lucrativos inscrita no CNPJ sob o nº **02.930.019/0001-62**, com sede na Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro, Guapó - GO, CEP 75350-000."*

---

## 3. Casos de Borda & Falhas (Edge Cases)

1. **Responsividade Mobile da Ficha Cadastral:** A tabela de dados cadastrais deve quebrar em grid colunar para visualização legível em telas pequenas.
2. **Página de Regimento Interno sem XML:** Em vez de exibir aviso de rascunho ("em transcrição"), a view deve exibir a estrutura regimental e a fundamentação legal oficial com artigos de vigência e competências dos órgãos diretivos, mantendo o botão de contato e consulta ao Estatuto Social.
3. **Links e Acessibilidade:** Manter todas as diretrizes WCAG 2.1 AA (contraste mínimo 4.5:1, landmarks semânticos e títulos hierárquicos).

---

## 4. Critérios de Aceitação & Plano de Verificação

### Critérios de Aceitação
- [ ] O rodapé de todas as páginas (`views/layouts/app.blade.php`) contém a declaração explícita de titularidade do domínio `ibnpguapo.org.br` pela Igreja Batista Nacional da Paz de Guapó com CNPJ e e-mail `contato@ibnpguapo.org.br`.
- [ ] A página `/sobre` exibe a seção "Ficha Cadastral e Jurídica" com Razão Social oficial, CNPJ, Data de Fundação, Natureza Jurídica 322-0, Endereço Completo e Domínio Titular.
- [ ] A página `/contato` exibe card de e-mail institucional `contato@ibnpguapo.org.br` e declaração de operação do domínio.
- [ ] A página `/regimento` NÃO contém menção a "Issue #4", "Transcrição Semântica" ou termos que sugiram rascunho/template inacabado, apresentando o corpo normativo e institucional regimental.
- [ ] O schema `agenda.schema.json` valida o e-mail de contato sem erros.
- [ ] 100% dos testes PHPUnit passam (`vendor/bin/phpunit`).
- [ ] 100% das regras de acessibilidade WCAG 2.1 AA passam (`node scripts/audit_accessibility.js`).
