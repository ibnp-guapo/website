# Especificação Técnica: Setup da Aplicação PHP 8.x, Composer, Tailwind CSS e Docker Compose

- **Identificador:** `SPEC-WDLC-F4-06`
- **Fase do WDLC:** F4 - Setup & Engenharia Base
- **Issue Relacionada:** [#6](https://github.com/ibnp-guapo/website/issues/6)
- **Status:** Aprovado e Implementado
- **Data:** 10/09/2026

---

## 1. Objetivo & Escopo

### 1.1 Objetivo
Estabelecer a infraestrutura de engenharia e a arquitetura base para o website da **Igreja Batista Nacional da Paz de Guapó**, configurando o ambiente de execução PHP 8.x, gerenciamento de dependências via Composer, pipeline de assets com Tailwind CSS, orquestração de contêineres Docker e integração contínua (CI) no GitHub Actions.

### 1.2 Goals (Em Escopo)
- Inicializar `composer.json` com PHP `>=8.2`, dependências de roteamento (`bramus/router`), templates Blade (`jenssegers/blade`) e testes (`phpunit/phpunit`).
- Configurar Tailwind CSS v3 via `package.json`, `tailwind.config.js` estendendo as cores canônicas da IBN da Paz (`#F43517`, `#F36529`, `#EFA162`, `#F1D6A9`, `#1E293B`, `#FFFFFF`) e fontes (`Inter`, `Merriweather`).
- Criar a estrutura de diretórios canônica: `public/`, `src/`, `views/`, `data/`, `docs/`, `scripts/`.
- Configurar Front Controller `public/index.php` com mapeamento das 7 rotas canônicas e resposta HTTP 404 personalizada.
- Configurar contêineres Docker (`Dockerfile` e `docker-compose.yml`) para os serviços `app`, `composer` e `tests`.
- Criar pipeline de Integração Contínua em `.github/workflows/ci.yml`.

### 1.3 Non-Goals (Fora de Escopo)
- Implementação detalhada dos templates Blade finais e renderizadores completos do Akoma Ntoso 3.0 (reservados para as fases F5 e F6).
- Configuração de banco de dados relacional (a aplicação é desacoplada e consome artefatos canônicos JSON e XML versionados).

---

## 2. Contratos & Arquitetura

### 2.1 Estrutura de Diretórios
```
ibnp-guapo-website/
├── .github/
│   └── workflows/
│       └── ci.yml                 # Pipeline CI GitHub Actions
├── data/
│   ├── legal/                     # Estatuto e Regimento (Akoma Ntoso XML)
│   └── programacao/               # Agenda semanal e cultos (JSON Schema)
├── docs/
│   └── specs/                     # Especificações SDD
├── public/
│   ├── assets/
│   │   └── css/
│   │       ├── input.css          # Ponto de entrada Tailwind
│   │       └── app.css            # CSS compilado e minificado
│   └── index.php                  # Front Controller & Roteamento
├── scripts/                       # Scripts de validação e automação
├── views/                         # Templates Blade (Fases F5/F6)
├── composer.json                  # Manifesto PHP / Composer
├── docker-compose.yml             # Orquestração de contêineres
├── Dockerfile                     # Imagem PHP 8.3 CLI Alpine
├── package.json                   # Dependências Node.js / Tailwind CSS
├── phpunit.xml                    # Configuração de testes unitários
└── tailwind.config.js             # Design System Tokens
```

### 2.2 Rotas Canônicas (Front Controller)
| Método | Rota | Descrição | Content-Type |
| :--- | :--- | :--- | :--- |
| `GET` | `/` | Página Inicial (Home) | `text/html; charset=utf-8` |
| `GET` | `/programacao` | Agenda e horários dos cultos | `text/html; charset=utf-8` |
| `GET` | `/programacao/ical`| Download do calendário (.ics) | `text/calendar; charset=utf-8` |
| `GET` | `/estatuto` | Consulta ao Estatuto Social (Akoma Ntoso 3.0) | `text/html; charset=utf-8` |
| `GET` | `/regimento` | Consulta ao Regimento Interno | `text/html; charset=utf-8` |
| `GET` | `/sobre` | História, confissão de fé e diretoria | `text/html; charset=utf-8` |
| `GET` | `/contato` | Localização, canais de atendimento e redes | `text/html; charset=utf-8` |
| `*` | * | Resposta 404 personalizada | `text/html; charset=utf-8` |

---

## 3. Integração Contínua (CI Pipeline)

O workflow `.github/workflows/ci.yml` executa 3 jobs concorrentes:
1. **validate-data:** Executa `python scripts/validate_xml.py` (validação Akoma Ntoso 3.0) e `python scripts/validate_agenda.py` (validação de schema JSON Draft 2020-12).
2. **validate-php:** Executa `composer validate --strict` e verificação de sintaxe de todos os arquivos PHP (`php -l`).
3. **validate-assets:** Instala dependências e compila o Tailwind CSS (`npm run build:css`), garantindo a integridade de `public/assets/css/app.css`.

---

## 4. Critérios de Aceitação & Verificação
- [x] `composer.json` válido e documentado.
- [x] Tailwind CSS v3 configurado e compilado em `public/assets/css/app.css` sem erros.
- [x] Front Controller `public/index.php` respondendo para as rotas canônicas e 404.
- [x] Dockerfile e docker-compose.yml estruturados.
- [x] Pipeline de CI `.github/workflows/ci.yml` cobrindo dados, PHP e CSS.
