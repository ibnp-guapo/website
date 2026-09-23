# Especificação Técnica 17: Transição da Linguagem Institucional para Foco em Impacto Social e Educação Infantil (Issue #15)

## 1. Objetivo & Escopo

### Contexto & Oportunidade
A organização **Igreja Batista Nacional da Paz de Guapó (IBNP)** atua como entidade mantenedora legal da **Escola Social de Guapó** e de programas contínuos de desenvolvimento infantil, cidadania e assistência comunitária. 

Conforme registrado na **Issue #15** (`https://github.com/ibnp-guapo/website/issues/15`), a instituição passa por um reposicionamento estratégico de marca para dialogar de forma mais inclusiva e universal com a comunidade de Guapó, famílias, doadores e parceiros mantenedores. Para isso, a linguagem do website institucional transita de uma narrativa eclesiástica confessional estrita para uma **comunicação focada em impacto social, educação infantil e acolhimento comunitário**.

### Goals (Dentro do Escopo)
1. **Auditoria e Substituição do Vocabulário (Matriz De-Para):**
   - Transição dos termos confessionais para terminologias voltadas ao desenvolvimento humano e comunitário nas páginas públicas (`/`, `/programacao`, `/sobre`, `/contato` e layouts).
2. **Atualização da Base de Dados da Programação (`data/programacao/agenda.json`):**
   - Adequação dos títulos e descrições dos encontros regulares para nomes acolhedores e socioeducativos.
3. **Reformulação da Comunicação de Doações & Apoio (PIX e Parcerias):**
   - Posicionamento da chave PIX e canais de apoio como doação para manutenção das iniciativas comunitárias e socioeducativas da instituição.
4. **Metadados e SEO Alinhados ao Impacto Social:**
   - Ajustar títulos (`title`), descrições (`meta_description`) e dados estruturados para refletir a nova identidade institucional.
5. **Ciclo TDD Mandatório (SDD):**
   - Criação/atualização de testes automatizados no PHPUnit assegurando que os novos termos estejam presentes e termos obsoletos eliminados da interface.

### Non-Goals (Fora do Escopo)
- Não alterar a razão social ou natureza jurídica registrada (`Igreja Batista Nacional da Paz de Guapó`, CNPJ `02.930.019/0001-62`, Natureza `322-0`).
- Não alterar os textos canônicos do Estatuto Social e Regimento Interno averbados em cartório (`/estatuto` e `/regimento`).
- Não alterar as rotas e URLs existentes para manter a integridade dos acessos e indexação de busca.

---

## 2. Contratos & Modelagem

### 2.1 Matriz Conceitual de Terminologia (De-Para)

| Termo Anterior (Linguagem Confessional) | Novo Termo (Linguagem Social & Comunitária) | Contexto de Aplicação |
| :--- | :--- | :--- |
| **Ministério Infantil / EBD** | **Programa de Desenvolvimento Infantil / Educação Infantil (Paz Kids)** | Hero, Cards de Iniciativas, Programação |
| **Grupo de Louvor / Louvor e Adoração** | **Iniciativa Cultural e Musical / Expressão Artística** | Programação e Cards de Atividades |
| **Cultos / Reuniões Eclesiásticas** | **Encontros Comunitários / Reuniões Institucionais** | Menus, Cabeçalhos, Horários, Agendas |
| **Culto de Ensino** | **Encontro de Ensino & Formação de Valores** | Quarta-feira 19:30 |
| **Culto de Celebração** | **Encontro Comunitário de Celebração & Acolhimento** | Domingo 19:30 |
| **Dízimos / Ofertas** | **Apoio Social / Doações & Parcerias Mantenedoras** | Card PIX, Rodapés, Formulários |
| **Missões / Evangelismo** | **Projetos de Impacto Social / Ações Comunitárias** | Pilares institucionais e ações locais |
| **Membros / Congregação** | **Comunidade / Rede de Famílias / Voluntariado** | Avisos, Textos sobre comunidade e integração |

### 2.2 Modelagem de Dados (`data/programacao/agenda.json`)
```json
{
  "$schema": "./agenda.schema.json",
  "organizacao": {
    "nome": "Igreja Batista Nacional da Paz de Guapó",
    "sigla": "IBN da Paz de Guapó",
    "cnpj": "02.930.019/0001-62",
    "timezone": "America/Sao_Paulo"
  },
  "cultosRegulares": [
    {
      "id": "culto-quarta-ensino",
      "diaSemana": "quarta-feira",
      "horario": "19:30",
      "duracaoMinutos": 90,
      "nome": "Encontro de Ensino & Formação de Valores",
      "categoria": "Formação & Desenvolvimento Comunitário",
      "local": "Sede Institucional - Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro, Guapó - GO",
      "descricao": "Momento aberto de aprendizado, desenvolvimento moral, reflexão ética e edificação humana para jovens, adultos e famílias.",
      "transmissaoAoVivo": false,
      "rrule": "FREQ=WEEKLY;BYDAY=WE"
    },
    {
      "id": "culto-domingo-celebracao",
      "diaSemana": "domingo",
      "horario": "19:30",
      "duracaoMinutos": 90,
      "nome": "Encontro Comunitário de Celebração & Acolhimento",
      "categoria": "Cultura, Música & Integração Social",
      "local": "Sede Institucional - Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro, Guapó - GO",
      "descricao": "Reunião comunitária com apresentações artísticas e musicais, acolhimento fraterno e fortalecimento de laços familiares e comunitários.",
      "transmissaoAoVivo": false,
      "rrule": "FREQ=WEEKLY;BYDAY=SU"
    }
  ],
  "eventosEspeciais": []
}
```

### 2.3 Ajustes Adicionais de Marca e Layout (Feedback de Refinamento)

1. **Unificação da Marca Pública para "IBNP":**
   - Substituição de "IBN da Paz de Guapó" e "IBN da Paz" na navegação, cabeçalhos, títulos de páginas (`title`), `alt` de logos e componentes pela sigla oficial unificada **"IBNP"**.
   - Preservação da razão social e dados formais (`Igreja Batista Nacional da Paz de Guapó - CNPJ 02.930.019/0001-62`) nas notas legais de rodapé e transparência jurídica.
2. **Simplificação da Localização para "Sede":**
   - Eliminação dos termos "Templo Sede" e "Sede Institucional", adotando estritamente **"Sede"** nos títulos de cards, agenda e componentes de mapa.
3. **Resolução de Overflow da Navbar Desktop:**
   - Encurtamento dos textos de links do menu (`Iniciativas`, `Estatuto`, `Regimento`) e aplicação de classes de responsividade com `shrink-0` e `ml-auto` no container do CTA "Planeje sua Visita", impedindo o deslocamento ou corte do botão para fora da tela.

---

## 3. Casos de Borda & Falhas (Edge Cases)

1. **Retrocompatibilidade de Âncoras:** Manter compatibilidade com `#ministerios` e adicionar `#iniciativas` para links antigos.
2. **Compatibilidade RFC 5545 (iCal):** Garantir que a geração do arquivo `.ics` mantenha acentuação e quebras de linha válidas com os novos títulos.
3. **SEO e Transparência Jurídica:** Manter menções legais à mantenedora e vínculos com CNPJ sem ambiguidades fiscais.

---

## 4. Critérios de Aceitação & Plano de Verificação

### Critérios de Aceitação
- [ ] Guia de De-Para aplicado em todas as páginas públicas (Home, Programação, Sobre, Contato e Rodapés).
- [ ] Marca visual pública padronizada como "IBNP" (mantendo dados formais no rodapé).
- [ ] Local de encontros unificado como "Sede" (eliminando "Templo Sede" e "Sede Institucional").
- [ ] Botão CTA "Planeje sua Visita" perfeitamente visível e contido na viewport sem quebras ou overflow na navbar.
- [ ] Eliminação de termos confessionais obsoletos nas áreas comuns de navegação.
- [ ] Validação do JSON Schema em `agenda.json`.
- [ ] 100% de aprovação na suíte de testes do PHPUnit (`./vendor/bin/phpunit`).

