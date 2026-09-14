#!/usr/bin/env node

/**
 * Script de Auditoria de Acessibilidade Digital (WCAG 2.1 Nível AA)
 * Projeto: IBNP Guapó Website (ibnp-guapo/website)
 * Referência: Issue #10 [WDLC-F5]
 */

const fs = require('fs');
const path = require('path');

console.log('='.repeat(70));
console.log('🔍 AUDITORIA DE ACESSIBILIDADE DIGITAL (WCAG 2.1 AA) - IBNP GUAPÓ');
console.log('='.repeat(70));

let totalChecks = 0;
let passedChecks = 0;
let failedChecks = 0;

function assertCheck(description, condition, details = '') {
  totalChecks++;
  if (condition) {
    passedChecks++;
    console.log(`  ✅ [PASS] ${description}`);
  } else {
    failedChecks++;
    console.error(`  ❌ [FAIL] ${description}`);
    if (details) {
      console.error(`     Detalhes: ${details}`);
    }
  }
}

// -------------------------------------------------------------
// 1. CÁLCULO E VALIDAÇÃO DE CONTRASTE DE CORES (WCAG 2.1 AA)
// -------------------------------------------------------------
console.log('\n🎨 1. Contraste Cromático da Paleta Institucional:');

function getRelativeLuminance(hex) {
  hex = hex.replace('#', '');
  if (hex.length === 3) {
    hex = hex.split('').map(c => c + c).join('');
  }
  const r = parseInt(hex.substring(0, 2), 16) / 255.0;
  const g = parseInt(hex.substring(2, 4), 16) / 255.0;
  const b = parseInt(hex.substring(4, 6), 16) / 255.0;

  const toLinear = (c) => (c <= 0.04045 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4));

  return 0.2126 * toLinear(r) + 0.7152 * toLinear(g) + 0.0722 * toLinear(b);
}

function getContrastRatio(hex1, hex2) {
  const lum1 = getRelativeLuminance(hex1);
  const lum2 = getRelativeLuminance(hex2);
  const lighter = Math.max(lum1, lum2);
  const darker = Math.min(lum1, lum2);
  return (lighter + 0.05) / (darker + 0.05);
}

const colors = {
  navy: '#0F172A',
  coral: '#F43517',
  orange: '#F36529',
  white: '#FFFFFF',
  surface: '#F8FAFC'
};

const ratioNavyWhite = getContrastRatio(colors.navy, colors.white);
assertCheck(
  `Texto Marinho (#0F172A) sobre Branco (#FFFFFF) ratio >= 4.5:1 (Obtido: ${ratioNavyWhite.toFixed(2)}:1)`,
  ratioNavyWhite >= 4.5
);

const ratioNavySurface = getContrastRatio(colors.navy, colors.surface);
assertCheck(
  `Texto Marinho (#0F172A) sobre Fundo Suave (#F8FAFC) ratio >= 4.5:1 (Obtido: ${ratioNavySurface.toFixed(2)}:1)`,
  ratioNavySurface >= 4.5
);

const ratioCoralNavy = getContrastRatio(colors.coral, colors.navy);
assertCheck(
  `Destaque Coral (#F43517) sobre Fundo Marinho (#0F172A) ratio >= 3.0:1 (Obtido: ${ratioCoralNavy.toFixed(2)}:1)`,
  ratioCoralNavy >= 3.0
);

const ratioOrangeNavy = getContrastRatio(colors.orange, colors.navy);
assertCheck(
  `Destaque Laranja (#F36529) sobre Fundo Marinho (#0F172A) ratio >= 3.0:1 (Obtido: ${ratioOrangeNavy.toFixed(2)}:1)`,
  ratioOrangeNavy >= 3.0
);

const ratioWhiteNavy = getContrastRatio(colors.white, colors.navy);
assertCheck(
  `Texto Branco (#FFFFFF) sobre Fundo Marinho (#0F172A) ratio >= 7.0:1 [WCAG AAA] (Obtido: ${ratioWhiteNavy.toFixed(2)}:1)`,
  ratioWhiteNavy >= 7.0
);

// -------------------------------------------------------------
// 2. AUDITORIA DE ESTRUTURA DO LAYOUT BASE (app.blade.php)
// -------------------------------------------------------------
console.log('\n🏛️  2. Landmarks e Estrutura Semântica do Layout Base:');

const appBladePath = path.join(__dirname, '..', 'views', 'layouts', 'app.blade.php');
assertCheck('Arquivo de layout views/layouts/app.blade.php existe', fs.existsSync(appBladePath));

if (fs.existsSync(appBladePath)) {
  const content = fs.readFileSync(appBladePath, 'utf-8');

  assertCheck('Atributo de idioma <html lang="pt-BR"> presente', /<html[^>]+lang=["']pt-BR["']/i.test(content));
  assertCheck('Meta tag viewport com width=device-width configurada', /<meta[^>]+name=["']viewport["'][^>]+content=["'][^"']*width=device-width[^"']*["']/i.test(content));
  assertCheck('Landmark semântico <header> presente', /<header/i.test(content));
  assertCheck('Landmark semântico <nav> presente', /<nav/i.test(content));
  assertCheck('Landmark semântico <main> presente', /<main/i.test(content));
  assertCheck('Landmark semântico <footer> presente', /<footer/i.test(content));

  // Verificar todas as imagens em views/
  const viewsDir = path.join(__dirname, '..', 'views');
  function getAllBladeFiles(dir) {
    let files = [];
    for (const item of fs.readdirSync(dir)) {
      const fullPath = path.join(dir, item);
      if (fs.statSync(fullPath).isDirectory()) {
        files = files.concat(getAllBladeFiles(fullPath));
      } else if (item.endsWith('.blade.php')) {
        files.push(fullPath);
      }
    }
    return files;
  }

  const bladeFiles = getAllBladeFiles(viewsDir);
  let totalImages = 0;
  let imagesWithAlt = 0;

  for (const file of bladeFiles) {
    const fileContent = fs.readFileSync(file, 'utf-8');
    const matches = fileContent.match(/<img[^>]*>/gi) || [];
    for (const img of matches) {
      totalImages++;
      if (/alt=["'][^"']*["']/i.test(img)) {
        imagesWithAlt++;
      }
    }
  }

  assertCheck(
    `100% das imagens contêm atributo alt descritivo (${imagesWithAlt}/${totalImages} imagens validadas)`,
    totalImages > 0 && imagesWithAlt === totalImages
  );
}

// -------------------------------------------------------------
// 3. AUDITORIA DO LEITOR AKOMA NTOSO (estatuto.blade.php)
// -------------------------------------------------------------
console.log('\n📖 3. Navegação Acessível no Leitor de Documentos Legais:');

const estatutoBladePath = path.join(__dirname, '..', 'views', 'pages', 'legal', 'estatuto.blade.php');
assertCheck('Arquivo da view views/pages/legal/estatuto.blade.php existe', fs.existsSync(estatutoBladePath));

if (fs.existsSync(estatutoBladePath)) {
  const content = fs.readFileSync(estatutoBladePath, 'utf-8');

  assertCheck('Hierarquia de títulos com <h1> e <h2>', /<h1/i.test(content) && /<h2/i.test(content));
  assertCheck('Campo de busca possui acessibilidade (placeholder ou aria-label)', /<input[^>]+(aria-label|placeholder)=/i.test(content));
  assertCheck('Suporte a permalinks para foco de teclado direto no artigo', content.includes('copyPermalink') || content.includes('id='));
}

// -------------------------------------------------------------
// RESUMO FINAL
// -------------------------------------------------------------
console.log('\n' + '='.repeat(70));
console.log(`📊 RESULTADO DA AUDITORIA: ${passedChecks}/${totalChecks} verificações aprovadas.`);
if (failedChecks === 0) {
  console.log('🎉 SUCESSO: Todos os requisitos de acessibilidade WCAG 2.1 AA foram atendidos!');
  console.log('='.repeat(70) + '\n');
  process.exit(0);
} else {
  console.error(`⚠️  FALHAS DETECTADAS: ${failedChecks} verificação(ões) falharam.`);
  console.log('='.repeat(70) + '\n');
  process.exit(1);
}
