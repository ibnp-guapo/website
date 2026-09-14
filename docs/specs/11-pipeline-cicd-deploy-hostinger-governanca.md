# [WDLC-F6/F7] Especificação Técnica: Pipeline CI/CD, Deploy Hostinger e Governança de Emendas via Git

> **Identificador:** SPEC-WDLC-F6-F7-CICD-DEPLOY-GOVERNANCA  
> **Status:** Proposto para Aprovação  
> **Referência GitHub:** [Issue #11](https://github.com/ibnp-guapo/website/issues/11)  
> **Dependências:** [Issue #10](https://github.com/ibnp-guapo/website/issues/10) (Suíte de Testes PHPUnit e Acessibilidade)  
> **Organização:** [ibnp-guapo](https://github.com/ibnp-guapo) / [website](https://github.com/ibnp-guapo/website)  
> **Ambiente Hostinger:** `https://lightcyan-kudu-279003.hostingersite.com/`  
> **Última Atualização:** 2026-09-14  

---

## 1. Objetivo & Escopo

### 1.1 Contexto e Problema
A Igreja Batista Nacional da Paz de Guapó (IBNP Guapó) consolidou sua base de código com o portal institucional em PHP 8.3/Blade/Tailwind, documentos jurídicos em Akoma Ntoso 3.0 (OASIS LegalDocML), agenda em JSON Schema e sincronização iCal (RFC 5545), além de suíte de testes com 44 testes e 422 asserções (Issue #10).

Para atingir a maturidade operacional e institucional (Fases 6 e 7 do WDLC), faz-se necessário:
1. Garantir que todo commit ou Pull Request na branch `main` seja testado automaticamente via GitHub Actions (incluindo testes PHPUnit, validações canônicas de XML/JSON e compilação de assets CSS);
2. Implantar e publicar o website no ambiente de produção contratado na Hostinger (`https://lightcyan-kudu-279003.hostingersite.com/`), mantendo isolamento da raiz da aplicação através de symlink seguro (`public_html -> ibnp-guapo-website/public`) e suporte a rotas amigáveis via `.htaccess`;
3. Formalizar o fluxo de **Governança Digital de Emendas Estatutárias via Git**, permitindo que futuras alterações aprovadas em Assembleia Geral Extraordinária sejam versionadas de maneira imutável, auditável e juridicamente referenciada nos metadados FRBR do Akoma Ntoso.

### 1.2 Objetivos no Escopo (Goals)
- **Roteamento Apache/LiteSpeed (`public/.htaccess`):**
  - Criar regra padrão de rewrite (`mod_rewrite`) redirecionando todas as requisições não estáticas para `index.php`.
- **Pipeline de Integração Contínua (`.github/workflows/ci.yml`):**
  - Integrar execução do `composer install` e da suíte completa de testes `composer test` (PHPUnit) no job `validate-php`.
  - Preservar validação de dados canônicos (`validate-data` com `validate_xml.py` e `validate_agenda.py`).
  - Preservar validação e compilação do Tailwind CSS (`validate-assets`).
- **Deploy no Servidor Hostinger (`Hostinger` via SSH):**
  - Conectar ao servidor Hostinger via SSH configurado em `~/.ssh/config` (`Host Hostinger`, porta 65002, usuário `u451023057`).
  - Fazer backup da pasta inicial `public_html` em `domains/lightcyan-kudu-279003.hostingersite.com/public_html.bak.<timestamp>`.
  - Clonar o repositório `https://github.com/ibnp-guapo/website.git` no diretório `domains/lightcyan-kudu-279003.hostingersite.com/ibnp-guapo-website`.
  - Criar symlink seguro: `public_html -> ibnp-guapo-website/public`.
  - Executar instalação de dependências de produção com Composer usando o PHP 8.3 CLI da Hostinger (`/opt/alt/php83/usr/bin/php /usr/local/bin/composer install --no-dev -o`).
  - Assegurar permissões de escrita (775) no diretório `storage/cache/views`.
  - Criar script de deploy automatizado em `/home/u451023057/scripts/deploy_ibnp_guapo.sh`.
- **Manual de Governança Eclesiástica (`docs/governanca-emendas.md`):**
  - Elaborar documento institucional direcionado à diretoria e conselho eclesiástico da igreja, descrevendo o fluxo de propostas de emenda, votação em assembleia, ata, atualização de metadados FRBR e auditoria pública via Git.
- **Validação E2E em Produção:**
  - Realizar chamadas HTTP em todas as rotas públicas (`/`, `/sobre`, `/programacao`, `/programacao/ical`, `/estatuto`, `/estatuto/xml`, `/regimento`, `/regimento/xml`, `/contato` e `/rota-inexistente` retornando 404).

### 1.3 Fora do Escopo (Non-Goals)
- Configuração de DNS de domínio final personalizado com registro externo (será realizado no momento da homologação definitiva pela liderança da igreja; no momento, o deploy valida o domínio Hostinger ativo `https://lightcyan-kudu-279003.hostingersite.com/`).
- Criação de banco de dados relacional (o projeto opera de maneira performática e resiliente via arquivos canônicos XML e JSON com cache Blade em disco).

---

## 2. Contratos & Modelagem

### 2.1 Contrato de Roteamento Apache (`public/.htaccess`)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ index.php [QSA,L]
</IfModule>
```

### 2.2 Topologia no Servidor Hostinger
```
/home/u451023057/
├── domains/
│   └── lightcyan-kudu-279003.hostingersite.com/
│       ├── ibnp-guapo-website/           # Repositório clonado (código-fonte)
│       │   ├── data/
│       │   ├── public/
│       │   │   ├── assets/
│       │   │   ├── .htaccess
│       │   │   └── index.php
│       │   ├── src/
│       │   ├── storage/
│       │   │   └── cache/views/          # Permissão 775 / escrita PHP
│       │   ├── vendor/                   # Dependências Composer
│       │   └── views/
│       ├── public_html -> ibnp-guapo-website/public   # Symlink seguro
│       └── public_html.bak.<timestamp>/  # Backup do estado inicial
└── scripts/
    └── deploy_ibnp_guapo.sh              # Script de atualização contínua
```

### 2.3 Contrato do Script de Deploy (`scripts/deploy_ibnp_guapo.sh`)
```bash
#!/bin/bash
set -e
export PATH="/opt/alt/php83/usr/bin:$PATH"

echo "=== Iniciando Deploy IBNP Guapó ==="
SITE_DIR="/home/u451023057/domains/lightcyan-kudu-279003.hostingersite.com/ibnp-guapo-website"
cd "$SITE_DIR"

echo "1. Atualizando código via Git..."
git pull origin main

echo "2. Instalando dependências de produção (Composer)..."
/opt/alt/php83/usr/bin/php /usr/local/bin/composer install --no-dev --optimize-autoloader --no-interaction

echo "3. Assegurando permissões no diretório de cache..."
mkdir -p storage/cache/views
chmod -R 775 storage/cache

echo "=== Deploy IBNP Guapó concluído com sucesso! ==="
```

### 2.4 Contrato do Pipeline de CI (`.github/workflows/ci.yml`)
O job `validate-php` deve conter os passos:
1. `Checkout do Repositório` (`actions/checkout@v4`)
2. `Configurar PHP` (`shivammathur/setup-php@v2` com PHP 8.3 e extensões `mbstring, xml, dom, ctype, json, zip`)
3. `Validar Composer Config` (`composer validate --strict`)
4. `Instalar Dependências Composer` (`composer install --prefer-dist --no-progress`)
5. `Lint PHP Files` (`find public src -name "*.php" -exec php -l {} \;`)
6. `Executar Testes PHPUnit` (`composer test` ou `vendor/bin/phpunit`)

---

## 3. Casos de Borda & Falhas (Edge Cases)

| ID | Cenário de Falha / Borda | Causa Possível | Mitigação / Tratamento na Spec |
|---|---|---|---|
| **EC-01** | Erro 404 em rotas amigáveis (`/sobre`, `/estatuto`) no servidor Hostinger | Falta de `.htaccess` na raiz pública ou `mod_rewrite` desabilitado | Adicionar `public/.htaccess` no repositório com regras `RewriteCond` e `RewriteRule ^ index.php [QSA,L]`. |
| **EC-02** | Erro 500 ao compilar views Blade ou cache Akoma Ntoso | Diretório `storage/cache/views` sem permissão de escrita para o processo Apache/PHP | Script de deploy cria o diretório explicitamente e aplica `chmod -R 775 storage/cache`. |
| **EC-03** | Versão incompatível do PHP no CLI da Hostinger (padrão é PHP 8.1) | Composer falha por requerer `php: >=8.2` | Executar Composer apontando explicitamente para o binário PHP 8.3 CloudLinux: `/opt/alt/php83/usr/bin/php /usr/local/bin/composer`. |
| **EC-04** | Exposição indevida de arquivos confidenciais ou código-fonte | `public_html` apontando para a raiz do repositório em vez da subpasta `public` | Criação de link simbólico `public_html -> ibnp-guapo-website/public`, mantendo `src`, `vendor`, `data` e `.git` fora da raiz pública do servidor web. |
| **EC-05** | Falha de sincronização no `git pull` por arquivos alterados no servidor | Mudanças manuais efetuadas dentro do servidor de produção | Manter política de imutabilidade: o servidor apenas recebe artefatos via `git pull`; qualquer alteração de dados ou código é feita via Pull Request. |
| **EC-06** | Quebra na formatação ou metadados de emenda do Estatuto | Alteração sem conformidade com OASIS Akoma Ntoso 3.0 XSD | CI bloqueia automaticamente o PR caso `validate_xml.py` ou `AkomaNtosoValidationTest.php` falhem. |

---

## 4. Critérios de Aceitação & Plano de Verificação

### Checklist de Critérios de Aceitação (DoD)
- [ ] `public/.htaccess` criado, commitado e validado.
- [ ] `.github/workflows/ci.yml` atualizado para rodar `composer install` e `composer test` com 100% de sucesso.
- [ ] `docs/governanca-emendas.md` elaborado em português institucional detalhando o fluxo de emendas estatutárias com referências ao Akoma Ntoso FRBR.
- [ ] Repositório sincronizado via push na branch `main`.
- [ ] Conexão SSH à Hostinger efetuada com sucesso:
  - Backup da pasta inicial `public_html` concluído.
  - Clone do repositório em `domains/lightcyan-kudu-279003.hostingersite.com/ibnp-guapo-website`.
  - Link simbólico `public_html -> ibnp-guapo-website/public` ativo.
  - Dependências de produção instaladas via Composer com PHP 8.3.
  - Permissões em `storage/cache` ajustadas.
  - Script `/home/u451023057/scripts/deploy_ibnp_guapo.sh` criado e testado.
- [ ] Todas as URLs em `https://lightcyan-kudu-279003.hostingersite.com/` respondendo com status HTTP 200 (e 404 para URLs desconhecidas):
  - `GET /` -> HTTP 200
  - `GET /sobre` -> HTTP 200
  - `GET /programacao` -> HTTP 200
  - `GET /programacao/ical` -> HTTP 200 (text/calendar)
  - `GET /estatuto` -> HTTP 200
  - `GET /estatuto/xml` -> HTTP 200 (application/xml)
  - `GET /regimento` -> HTTP 200
  - `GET /contato` -> HTTP 200
  - `GET /rota-inexistente` -> HTTP 404 institucional
