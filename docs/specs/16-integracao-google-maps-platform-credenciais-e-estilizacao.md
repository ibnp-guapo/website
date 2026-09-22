# Especificação Técnica 16: Integração Google Maps Platform, Governança Cloud, Estilização Institucional e Deploy em Produção

## 1. Objetivo & Escopo

### Contexto & Oportunidade
A organização **Igreja Batista Nacional da Paz de Guapó** obteve a aprovação oficial de créditos mensais de **US$ 250** (válidos até 01/10/2027) na plataforma **Google Maps Platform**, vinculados à conta de faturamento `019760-86D4ED-2A323C` e projeto GCP `project-9490b723-ff63-4b9b-987`.

Atualmente, o site institucional (`ibnpguapo.org.br`) exibe mapas em `iframe` com parâmetros estáticos genéricos nas páginas `/` (Home) e `/contato`, sem vinculação com a chave de API oficial concedida e sem estilização alinhada ao Design System institucional (*Warm Fellowship*).

### Goals (Dentro do Escopo)
1. **Governança & Segurança Cloud (GCP via `gcloud` CLI):**
   - Habilitar os serviços necessários no projeto `project-9490b723-ff63-4b9b-987`:
     - `maps-backend.googleapis.com` (*Maps JavaScript API*)
     - `maps-embed-backend.googleapis.com` (*Maps Embed API*)
     - `billingbudgets.googleapis.com` (*Cloud Billing Budget API*)
   - Criar Alerta de Orçamento (*Budget & Alerts*) para a conta `019760-86D4ED-2A323C` com patamares de 50%, 90% e 100% para prevenir qualquer cobrança não planejada.
   - Provisionar Chave de API restrita (`ibnp-guapo-maps-web`):
     - **Restrição de Aplicativo (HTTP Referrers):** `https://ibnpguapo.org.br/*`, `https://*.ibnpguapo.org.br/*`, `http://localhost:*`, `http://127.0.0.1:*`.
     - **Restrição de API:** Apenas `maps-backend.googleapis.com` e `maps-embed-backend.googleapis.com`.
2. **Ambiente Local & Produção (`.env`):**
   - Adicionar variável `GOOGLE_MAPS_API_KEY` ao `.env.example` e `.env` local.
   - **Deploy e Configuração em Produção (VPS Hostinger):**
     - Conectar via SSH ao host Hostinger (`Host Hostinger` no `.ssh/config`).
     - Configurar o arquivo `/home/u451023057/domains/ibnpguapo.org.br/ibnp-guapo-website/.env` com a chave `GOOGLE_MAPS_API_KEY` oficial gerada.
     - Garantir permissões de segurança restritas no arquivo (`chmod 600 .env`).
     - Executar deploy e limpeza de cache de views via `/home/u451023057/scripts/deploy_ibnp_guapo.sh`.
3. **Componente Reutilizável de Mapa Institucional:**
   - Criar classe auxiliar segura de ambiente `App\Support\Env` para leitura de `.env` sem depender de pacotes externos pesados.
   - Criar componente Blade `views/components/google-map.blade.php` que:
     - Renderize o mapa interativo dinâmico (*Maps JavaScript API*) quando `GOOGLE_MAPS_API_KEY` estiver configurada.
     - Aplique paleta estilizada *Warm Fellowship* (tons acolhedores, contraste suave, destaque para a localização da igreja).
     - Insira marcador (*pin*) exclusivo com InfoWindow informativa (Nome do Templo, Endereço, Horários dos Cultos e botão direto "Traçar Rota").
     - Habilite navegação cooperativa de gestos (`gestureHandling: 'cooperative'`) para que a rolagem de página em dispositivos móveis não fique presa no mapa.
     - Forneça fallback gracioso para `iframe` Embed ou link direto de rotas caso a chave de API esteja ausente ou o carregamento do script falhe.
4. **Integração nas Views Oficiais:**
   - Atualizar `views/pages/contato.blade.php` e `views/pages/home.blade.php` para utilizar o novo componente institucional.
5. **Cobertura de Testes (TDD & Regressão):**
   - Criar testes automatizados no PHPUnit verificando a renderização dos elementos do mapa, atributos de acessibilidade (ARIA, títulos), suporte à variável de ambiente e links de rotas alternativas.

### Non-Goals (Fora do Escopo)
- Não alterar as credenciais de outros serviços ou bancos de dados na VPS.
- Não expor chaves de API irrestritas no front-end.
- Não remover as rotas externas tradicionais de navegação (Google Maps / Waze) que membros e visitantes utilizam em aplicativos nativos de celular.

---

## 2. Contratos & Modelagem

### 2.1 Coordenadas e Metadados do Templo Sede
- **Latitude:** `-16.8315`
- **Longitude:** `-49.5317`
- **Zoom Padrão:** `16`
- **Título do Local:** `Igreja Batista Nacional da Paz de Guapó`
- **Endereço Completo:** `Rua Presidente Kennedy, Qd. 21, Lt. 13, Centro, Guapó - GO, CEP 75350-000`
- **URL Canônica de Rota:** `https://www.google.com/maps/dir/?api=1&destination=-16.8315,-49.5317`

### 2.2 Variáveis de Ambiente (`.env` e `.env.example`)
```ini
# Google Maps Platform
GOOGLE_MAPS_API_KEY=AIzaSy...
```

### 2.3 Topologia na Produção (VPS Hostinger)
- **Host SSH:** `Hostinger` (definido no `~/.ssh/config`, porta 65002, usuário `u451023057`)
- **Caminho da Aplicação:** `/home/u451023057/domains/ibnpguapo.org.br/ibnp-guapo-website`
- **Arquivo `.env` de Produção:** `/home/u451023057/domains/ibnpguapo.org.br/ibnp-guapo-website/.env`
- **Script de Deploy e Cache:** `/home/u451023057/scripts/deploy_ibnp_guapo.sh`
- **URL Pública Oficial:** `https://ibnpguapo.org.br`

### 2.4 Contrato da Classe de Ambiente (`App\Support\Env`)
```php
namespace App\Support;

final class Env
{
    public static function get(string $key, ?string $default = null): ?string;
}
```

### 2.5 Contrato do Componente Blade (`views/components/google-map.blade.php`)
```php
@props([
    'lat' => -16.8315,
    'lng' => -49.5317,
    'zoom' => 16,
    'heightClass' => 'h-72 sm:h-96',
    'title' => 'Templo Sede - IBN da Paz de Guapó',
    'mapId' => 'ibnp-google-map',
    'showDirections' => true
])
```

---

## 3. Casos de Borda & Falhas (Edge Cases)

1. **Chave de API Ausente ou Inválida (`GOOGLE_MAPS_API_KEY=null`):**
   - O componente deve degradar graciosamente para o `iframe` de Embed com parâmetros padrão ou um card informativo com link direto para o Google Maps, sem quebrar o layout nem emitir erros fatais em PHP/Blade.
2. **Falha de Carregamento de Rede / Bloqueador de Anúncios:**
   - Se a biblioteca `maps.googleapis.com` for bloqueada por extensões (uBlock/Brave Shields), uma mensagem de fallback com botão "Abrir rota no Google Maps" permanece visível e clicável.
3. **Usabilidade Mobile (Armadilha de Rolagem / Scroll Trap):**
   - Em smartphones, se `gestureHandling` estiver configurado como `greedy`, o usuário não consegue rolar a página para baixo ao tocar na área do mapa. O mapa DEVE utilizar `gestureHandling: 'cooperative'` (exige dois dedos para movimentar o mapa no mobile).
4. **Contraste e Acessibilidade (WCAG 2.1 AA):**
   - O container do mapa deve possuir `role="region"`, `aria-label="Mapa de localização da Igreja Batista Nacional da Paz de Guapó"`.
   - Elementos interativos dentro do InfoWindow devem possuir foco visível e contraste adequado.

---

## 4. Critérios de Aceitação & Plano de Verificação

### Critérios de Aceitação (Checklist)
- [ ] Serviços GCP `maps-backend.googleapis.com`, `maps-embed-backend.googleapis.com` e `billingbudgets.googleapis.com` habilitados no projeto `project-9490b723-ff63-4b9b-987`.
- [ ] Orçamento (*Budget*) de monitoramento configurado na conta `019760-86D4ED-2A323C` com alertas em 50%, 90% e 100%.
- [ ] Chave de API criada via `gcloud` com restrição de HTTP Referrers (`ibnpguapo.org.br/*`, `*.ibnpguapo.org.br/*`, `localhost:*`, `127.0.0.1:*`) e restrição de APIs.
- [ ] Variável `GOOGLE_MAPS_API_KEY` documentada em `.env.example` e configurada no `.env` local.
- [ ] Arquivo `.env` de produção configurado na VPS Hostinger (`Host Hostinger` em `/home/u451023057/domains/ibnpguapo.org.br/ibnp-guapo-website/.env`) com permissão 600.
- [ ] Deploy executado com sucesso em produção via `/home/u451023057/scripts/deploy_ibnp_guapo.sh`.
- [ ] Componente Blade de mapa reutilizável implementado com suporte a API JS, estilização acolhedora e fallback resiliente.
- [ ] Páginas `/` (Home) e `/contato` utilizam a nova solução integrada.
- [ ] 100% dos testes unitários/funcionais no PHPUnit passam sem regressões.
- [ ] Auditoria de acessibilidade sem violações WCAG 2.1 AA.
- [ ] Verificação HTTP 200 em produção nas rotas `https://ibnpguapo.org.br/` e `https://ibnpguapo.org.br/contato`.
