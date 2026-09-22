# Especificação Técnica 15: Conformidade Google Ad Grants — Performance, Navegação Clara, Conteúdo Significativo e Calls-to-Action

## 1. Objetivo & Escopo

### Problema
A solicitação de ativação do **Google Ad Grants** para a organização religiosa sem fins lucrativos **Igreja Batista Nacional da Paz de Guapó** (`ibnpguapo.org.br`) recebeu a seguinte devolutiva de reprovação:
> *"Sua solicitação de ativação precisa de ajustes. O site da sua organização não atende aos padrões das políticas para sites do Ad Grants (https://support.google.com/grants/answer/1657899). Atualize suas páginas e envie novamente a solicitação de ativação para análise. Faça alterações para aumentar a velocidade de carregamento do site e oferecer uma navegação clara. Inclua conteúdo significativo e atualizado, além de calls-to-action."*

### Diagnóstico Técnico das Causas
1. **Velocidade de Carregamento (Performance & Core Web Vitals):**
   - Ausência de compressão GZIP/Deflate e cabeçalhos de cache de longo prazo (`Cache-Control`, `Expires`) no `.htaccess`.
   - Carregamento de imagem de mapa externa em `https://lh3.googleusercontent.com/aida-public/...` que adiciona latência externa de DNS/TLS e bloqueio de renderização.
   - Folha de fontes do Google Fonts (`Material Symbols Outlined` e `Plus Jakarta Sans`) sem otimização de `preconnect` antecipado e `font-display: swap` completo.
   - Falta de atributos explícitos de dimensão (`width`, `height`) e prioridade (`fetchpriority="high"`, `loading="eager"`) no elemento LCP da imagem Hero.
2. **Navegação Clara & Usabilidade (Clear Navigation):**
   - Rota de calendário `/programacao.ics` vinculada em vários pontos do site sem alias correspondente na rota `/programacao/ical`, gerando potencial 404 em cliques diretos.
   - Ausência de CTA prioritário no Header para orientar visitantes imediatos (ex: *"Planeje sua Visita"* / *"Participe dos Cultos"*).
   - Menu desktop e mobile sem indicação estruturada dos eixos de atuação comunitária e ministérios da igreja.
3. **Conteúdo Significativo e Atualizado (Substantial, Active & Up-to-date Content):**
   - Presença de termos e badges como `"Projeto em Construção & Implantação"`, `"Estrutura em obras"`, `"Acompanhar Obras & Projeto"` e ícones de `construction`. A política oficial do Ad Grants rejeita terminantemente sites com badges ou menções a *"em construção / obras / rascunho"*, interpretando como site incompleto.
   - O portal foca excessivamente no aspecto físico das obras da Escola Social, sem descrever os ministérios ativos e o dinamismo da comunidade eclesiástica (Ministério Infantil Paz Kids, Louvor & Adoração, Discipulado e Apoio Social a famílias de Guapó).
4. **Calls-to-Action (CTAs) em Destaque:**
   - Para organizações sem fins lucrativos no Ad Grants, é indispensável apresentar botões de ação e engajamento claros:
     - *Planeje sua Visita aos Cultos* (boas-vindas para novos participantes);
     - *Atendimento Pastoral e Aconselhamento no WhatsApp* (botão direto com mensagem formatada);
     - *Envio de Pedido de Oração*;
     - *Voluntariado e Apoio às Ações Sociais*;
     - *Dízimos e Ofertas via PIX* (com transparência e cópia em um clique).

### Goals (Dentro do Escopo)
- Otimizar o arquivo `.htaccess` com compressão `mod_deflate` (GZIP) e regras de cache estático `mod_expires` / `mod_headers`.
- Otimizar carregamento de fontes e recursos com `preconnect`, `display=swap`, `fetchpriority="high"` e remoção da dependência da imagem de mapa externa, substituindo por um elemento nativo/iframe rápido e leve com `loading="lazy"`.
- Registrar alias `/programacao.ics` no roteador para mapear diretamente para o gerador de calendário iCal RFC 5545.
- Atualizar a navegação global (`views/layouts/app.blade.php`) com links claros e botão de CTA em destaque no cabeçalho (*"Planeje sua Visita"*).
- Eliminar integralmente menções a "em construção", "obras" e ícones `construction`, reestruturando o conteúdo para focar na missão ativa da Ação Social e nos ministérios da igreja (Infantil Paz Kids, Louvor, Discipulado, Apoio Social Comunitário).
- Implementar seção dedicada de Ministérios & Vida da Igreja e CTAs destacados de engajamento (Visita, Atendimento Pastoral WhatsApp, Pedido de Oração, Voluntariado e Contribuição PIX).
- Atualizar a suíte de testes do PHPUnit (`PageRoutesTest`, `HttpRoutesTest`, `AccessibilityWcagTest`) e a auditoria de acessibilidade para garantir 100% de sucesso.

### Non-Goals (Fora do Escopo)
- Não alterar a estrutura do Estatuto Social canônico em XML Akoma Ntoso 3.0 averbado em cartório.
- Não alterar o endereço nem dados cadastrais da igreja (CNPJ 02.930.019/0001-62).
- Não introduzir dependências ou bibliotecas JavaScript pesadas que prejudiquem a velocidade de carregamento.

---

## 2. Contratos & Modelagem

### 2.1 Roteamento HTTP (`public/index.php`)
Adição da rota canônica com extensão `.ics`:
```php
// Rota 3.1: Alias direto com extensão canônica (.ics)
$router->get('/programacao.ics', function () use ($programacaoController): void {
    $programacaoController->ical();
});
```

### 2.2 Configuração de Servidor (`public/.htaccess`)
Inclusão de compressão e cache para aceleração máxima de entrega:
```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json image/svg+xml
</IfModule>

<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType text/css "access plus 1 year"
    ExpiresByType application/javascript "access plus 1 year"
    ExpiresByType font/woff2 "access plus 1 year"
</IfModule>
```

### 2.3 Modelo de Ministérios e Ação Comunitária (`views/pages/home.blade.php` e `views/pages/sobre.blade.php`)
Estruturação de blocos substantivos:
1. **Ministério Infantil (Paz Kids):** Cuidado, acolhimento e ensino bíblico lúdico e formativo durante os cultos dominicais.
2. **Ministério de Louvor e Adoração:** Música cristã congregacional e proclamação do Evangelho.
3. **Ministério Pastoral & Discipulado:** Acompanhamento familiar, aconselhamento e pequenos grupos de estudo.
4. **Ação Social Comunitária:** Atendimento a famílias em situação de vulnerabilidade no município de Guapó, arrecadação de donativos e mantenedora da Escola Social.

### 2.4 Contratos de Calls-to-Action (CTAs)
- **CTA Visita:** Link para `#programacao` ou `/programacao` com âncora e destaque visual.
- **CTA WhatsApp Pastoral:** `https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20informa%C3%A7%C3%B5es%20e%20atendimento%20pastoral%20na%20IBN%20da%20Paz%20de%20Guap%C3%B3.`
- **CTA Pedido de Oração:** Link direto para o canal de oração no WhatsApp com mensagem específica: `https://wa.me/556298700089?text=Ol%C3%A1!%20Gostaria%20de%20enviar%20um%20pedido%20de%20ora%C3%A7%C3%A3o%20para%20a%20IBN%20da%20Paz.`
- **CTA Contribuição PIX:** Chave CNPJ `02.930.019/0001-62` com botão de cópia rápida.

---

## 3. Casos de Borda & Falhas (Edge Cases)

1. **Acesso direto a `/programacao.ics` ou `/programacao/ical`:** Ambos devem responder HTTP 200 com cabeçalho `Content-Type: text/calendar; charset=utf-8` e conteúdo RFC 5545 válido.
2. **Desativação de JavaScript no Cliente:** Todos os CTAs funcionam como links HTML padrão (`<a>` com `href` canônico), garantindo rastreabilidade e indexação por robôs do Google sem depender de scripts.
3. **Dispositivos Móveis e Telas Pequenas:** O menu drawer deve manter contraste alto (WCAG AA), botões com alvos de toque maiores que 44x44px e fechar com clareza.
4. **Performance com Redes Lentas (3G/4G):** Imagens com dimensões definidas para evitar Cumulative Layout Shift (CLS), eliminação de requests a CDNs desconhecidos e compressão GZIP ativada.

---

## 4. Critérios de Aceitação & Plano de Verificação

### Critérios de Aceitação
- [ ] O arquivo `public/.htaccess` contém regras de compressão `mod_deflate` e políticas de cache `mod_expires`.
- [ ] A rota `/programacao.ics` retorna HTTP 200 com cabeçalhos e conteúdo de iCalendar válidos.
- [ ] Nenhum arquivo de visualização (`app.blade.php`, `home.blade.php`, `sobre.blade.php`, `contato.blade.php`) contém menção a "em construção", "obras", "construção e estruturação" ou o ícone `construction`.
- [ ] O cabeçalho global inclui CTA visível em destaque (*"Planeje sua Visita"*).
- [ ] A página inicial exibe a nova seção de Ministérios da Igreja (Paz Kids, Louvor, Discipulado, Ação Social) com descrições ricas e ativas.
- [ ] Os CTAs de engajamento (Planeje sua Visita, Atendimento Pastoral, Pedido de Oração, Ação Social e PIX) estão presentes, acessíveis e operacionais.
- [ ] 100% dos testes da suíte PHPUnit (`tests/Feature/PageRoutesTest.php`, `HttpRoutesTest.php`, `AccessibilityWcagTest.php`) passam com sucesso.
- [ ] A auditoria de acessibilidade (`npm run audit:a11y`) conclui com 17/17 verificações aprovadas.
