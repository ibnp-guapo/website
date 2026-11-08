# Especificação Técnica 24: Guia de Chegada para Novos Moradores de Guapó

## 1. Objetivo & Escopo

### Problema
A IBNP recebe muitas famílias que migram de outras regiões do país, especialmente do Norte, para Guapó-GO em busca de melhor qualidade de vida. Quem chega precisa resolver documentos, saúde, escola das crianças, trabalho e assistência social, e muitas vezes não sabe por onde começar. Hoje o site não oferece nenhuma orientação para esse público.

### Goals (Dentro do Escopo)
1. **Nova rota interna `GET /guia-de-chegada`** com `PageController::guiaDeChegada()` e view `views/pages/guia-de-chegada.blade.php` (estende `layouts.app`).
2. **Conteúdo prático em linguagem simples**, organizado por tema:
   - Boas-vindas e "Primeiros passos" (lista de verificação).
   - Documentos (CPF, Carteira de Identidade Nacional, comprovante de endereço).
   - Saúde (Cartão SUS / UBS do bairro / Meu SUS Digital).
   - Escola das crianças (rede municipal e estadual, documentos de transferência).
   - Assistência social (atualização do Cadastro Único no CRAS para não perder o Bolsa Família).
   - Trabalho (Carteira de Trabalho Digital, Sine/Vapt Vupt, seguro-desemprego).
   - Título de eleitor (transferência de domicílio eleitoral pelo TSE).
   - Moradia (cuidados contra golpes no aluguel).
   - Telefones de emergência e utilidade pública nacionais.
   - Como a IBNP pode ajudar (acolhimento, orientação, WhatsApp, encontros).
3. **Navegação:** link "Novo em Guapó" na gaveta móvel e nos links rápidos do rodapé, com `currentRoute === '/guia-de-chegada'`. O menu desktop já está no limite de largura em `xl` e não recebe item novo.
4. **Testes:** `PageRoutesTest` cobre renderização, seções e ausência de termos vetados (Ad Grants).

### Non-Goals (Fora do Escopo)
- **Não publicar endereços ou telefones de órgãos locais** (CRAS, UBS, Vapt Vupt de Guapó) sem confirmação oficial. A Secretaria de Educação, a Prefeitura e as unidades da Assistência Social já foram confirmadas no site oficial. Em 08/11/2026 não foi possível confirmá-los em fonte oficial; a página orienta a pessoa a procurar a prefeitura ou falar com a IBNP. Quando a igreja confirmar os dados, eles entram numa seção "Endereços em Guapó".
- Não prometer ajuda material (cestas, moradia, dinheiro) que a igreja não tenha confirmado.
- Não criar formulário de cadastro de recém-chegados.

## 2. Contratos

```php
// public/index.php — Rota 10
$router->get('/guia-de-chegada', fn () => $pageController->guiaDeChegada());
```

```php
// src/Controllers/PageController.php
public function guiaDeChegada(): void
{
    header('Content-Type: text/html; charset=utf-8');
    echo $this->renderer->render('pages.guia-de-chegada', [
        'currentRoute' => '/guia-de-chegada',
    ]);
}
```

## 3. Fontes das orientações
Somente regras nacionais ou estaduais estáveis, com link para o serviço oficial:
- Carteira de Identidade Nacional e CPF: gov.br.
- Cartão SUS / Meu SUS Digital: Ministério da Saúde.
- Cadastro Único e Bolsa Família: MDS, Disque Social **121**.
- Matrícula na rede estadual (6º ano ao ensino médio e EJA): portal https://matricula.go.gov.br/ (Governo de Goiás). Sem datas na página, para não exigir atualização anual.
- Escolas públicas de Guapó: rede municipal (3 CMEIs e 6 escolas) e contatos da Secretaria Municipal de Educação e Cultura e da Prefeitura conforme o site oficial https://guapo.go.gov.br/estrutura/secretaria-de-educacao-e-cultura/ (consultado em 08/11/2026); rede estadual (5 escolas) pelos dados do Inep. Não publicar nomes de diretores, que mudam com frequência.
- Carteira de Trabalho Digital: gov.br.
- Assistência Social de Guapó: unidades (Cadastro Único e Bolsa Família, CRAS, Programa Criança Feliz, CREAS, Conselho Tutelar, Departamento de Habitação) com endereço, telefone e horário da API oficial do site da Prefeitura (`/wp-json/wp/v2/estrutura?parent=6597`, consultada em 08/11/2026).
- Vagas de emprego: cadastro no Sine pela Prefeitura de Goiânia (https://www.goiania.go.gov.br/sing_servicos/cadastro-para-vagas-de-emprego/), on-line pelo Portal Emprega Brasil ou app Sine Fácil; telefone (62) 3524-1476. O endereço presencial não entrou porque a página oficial mostra dois endereços diferentes.
- Transferência de título: TSE (Autoatendimento Eleitoral). Exige ao menos 3 meses de residência no novo município e 1 ano desde o alistamento ou a última transferência.
- Emergência: 190, 192, 193; Disque Saúde 136; Direitos Humanos 100; Central da Mulher 180.

## 4. Critérios de Aceite
- [ ] `/guia-de-chegada` responde 200 com título "Guia de Chegada" e as seções acima.
- [ ] Link "Novo em Guapó" no menu móvel e no rodapé.
- [ ] Links externos abrem em nova aba com `rel="noopener noreferrer"`.
- [ ] Nenhum endereço ou telefone local não confirmado.
- [ ] Testes PHPUnit passando.

## 5. SEO
- **Layout (todas as páginas):** `<link rel="canonical">` e `og:url` a partir de `$currentRoute` com base `https://ibnpguapo.org.br`; Open Graph (`og:title`, `og:description`, `og:image`, `og:locale=pt_BR`) e Twitter Card `summary_large_image`. Páginas sem rota (404) recebem `noindex, follow`. Seções opcionais: `og_image` (caminho) e `og_image_alt`; padrão `hero-transformacao-infantil.jpg`.
- **Guia de Chegada:** título "Mudou para Guapó-GO? Guia para novos moradores | IBNP", descrição de até 160 caracteres com os termos buscados (documentos, Cartão SUS, escola, Cadastro Único, título de eleitor) e imagem de compartilhamento 1200×630 `public/assets/images/og-guia-de-chegada.jpg` (para o link aparecer bem no WhatsApp).
- **Dados estruturados (JSON-LD):** `WebPage` + `BreadcrumbList` + `HowTo` (os 6 primeiros passos) + `Church` (IBNP).
- **`public/robots.txt`** e **`public/sitemap.xml`** com todas as rotas públicas. Ao criar uma página nova, inclua-a no sitemap.
