#!/bin/bash
set -e
export PATH="/opt/alt/php83/usr/bin:$PATH"

echo "=== Iniciando Deploy IBNP Guapo na Hostinger ==="
SITE_DIR="/home/u451023057/domains/ibnpguapo.org.br/ibnp-guapo-website"
cd "$SITE_DIR"

echo "1. Atualizando codigo via Git..."
git pull origin main

echo "2. Instalando dependencias Composer de producao..."
/opt/alt/php83/usr/bin/php /usr/local/bin/composer install --no-dev --optimize-autoloader --no-interaction

echo "3. Limpando cache de views e assegurando permissoes..."
mkdir -p storage/cache/views
rm -f storage/cache/views/*.php
chmod -R 775 storage

echo "=== Deploy IBNP Guapo concluido com sucesso! ==="
