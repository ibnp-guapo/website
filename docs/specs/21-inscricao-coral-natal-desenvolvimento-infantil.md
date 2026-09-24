# Especificação Técnica 21: Página de Inscrição — Coral de Natal (Programa de Desenvolvimento Infantil)

## 1. Objetivo & Escopo

### Problema & Contexto
No âmbito do **Programa de Desenvolvimento Infantil** da IBNP (Igreja Batista Nacional da Paz de Guapó), será oferecida uma oficina preparatória de canto coral infantil para a apresentação especial de Natal no mês de dezembro.
Enquanto o poder público municipal de Guapó incentiva a musicalização infantil através de bandas marciais, a IBNP atua de forma complementar oferecendo a iniciação ao canto coletivo, afinação vocal, ritmo e formação socioemocional e ética para crianças.

Para garantir a qualidade pedagógica, o acolhimento individualizado e a segurança das crianças, o projeto possui um **limite estrito de 30 vagas gratuitas**, direcionadas à faixa etária de **5 a 12 anos**. É necessária uma página oficial e moderna de divulgação e inscrição no portal `ibnpguapo.org.br`, permitindo que os pais e responsáveis façam a inscrição online de forma rápida, com controle de vagas e confirmação integrada via WhatsApp.

### Goals (Dentro do Escopo)
1. **Nova Rota de Divulgação e Inscrição:**
   - Rota `GET /coral-natal` (com alias `/desenvolvimento-infantil/coral-natal` para indexação institucional).
   - Rota `POST /coral-natal/inscrever` para processar a submissão do formulário.
2. **Controller e Serviço Especializados:**
   - Criação de `App\Controllers\CoralNatalController` e `App\Services\InscricaoCoralService`.
   - Armazenamento atômico das inscrições em `storage/data/inscricoes_coral_natal.json`, com uso de trava de arquivo (`flock(LOCK_EX)`) para prevenir concorrência (*race condition*).
   - Contador de vagas em tempo real: 30 vagas máximas. Quando atingir 30, o formulário é bloqueado e exibe aviso de "Vagas Esgotadas", oferecendo canal direto via WhatsApp para lista de espera.
3. **Validação de Dados e Regras de Negócio:**
   - `nome_crianca`: obrigatório, mínimo 3 e máximo 100 caracteres, sanitizado.
   - `idade_crianca`: obrigatório, numérico inteiro entre 5 e 12 anos (conforme aprovado).
   - `nome_responsavel`: obrigatório, mínimo 3 e máximo 100 caracteres.
   - `telefone_responsavel`: WhatsApp válido com DDD (mínimo 10 dígitos numéricos).
   - `observacoes`: opcional, texto de até 255 caracteres.
4. **Experiência do Usuário (UI/UX) & Imagens:**
   - Template Blade moderno `views/pages/coral-natal.blade.php` com o design system do portal (paleta warm/cream, tipografia Plus Jakarta Sans e ícones Material Symbols).
   - Uso de fotografia contextual de alta qualidade de coral/música infantil hospedada localmente em `public/assets/images/coral-natal-criancas.jpg` (otimizada para Core Web Vitals e sem dependência de terceiros).
   - Tela de confirmação amigável com botão de envio do comprovante para o WhatsApp oficial da IBNP com mensagem pré-formatada.
5. **Divulgação no Portal:**
   - Destaque discreto e elegante na página `/acao-social` e na seção de iniciativas da Home apontando para a oportunidade do Coral de Natal em Dezembro.
6. **Acessibilidade e Testes Automatizados:**
   - Conformidade WCAG 2.1 AA (contraste, labels semânticos, atributos `required` e `aria-invalid`).
   - Cobertura de testes unitários e de integração no PHPUnit cobrindo rotas, validações, limites de vaga e concorrência.

### Non-Goals (Fora do Escopo)
- Não cobrar valores nem criar gateway de pagamento (a participação no coral infantil é 100% gratuita).
- Não exigir login ou cadastro prévio de conta de usuário para os responsáveis.
- Não alterar a base do Estatuto Social nem credenciais do Google Ads/Analytics.

---

## 2. Contratos & Modelagem

### 2.1 Roteamento HTTP (`public/index.php`)
```php
// Rotas do Coral de Natal (Programa de Desenvolvimento Infantil)
$coralController = new \App\Controllers\CoralNatalController();

$router->get('/coral-natal', function () use ($coralController): void {
    $coralController->index();
});

$router->get('/desenvolvimento-infantil/coral-natal', function () use ($coralController): void {
    $coralController->index();
});

$router->post('/coral-natal/inscrever', function () use ($coralController): void {
    $coralController->inscrever();
});
```

### 2.2 Estrutura do DTO / JSON de Inscrição (`storage/data/inscricoes_coral_natal.json`)
```json
[
  {
    "id": "canto-2026-0001",
    "numero_vaga": 1,
    "nome_crianca": "Maria Clara Santos",
    "idade_crianca": 8,
    "nome_responsavel": "Ana Paula Santos",
    "telefone_responsavel": "(62) 98765-4321",
    "observacoes": "Já participou de apresentações na escola",
    "criado_em": "2026-09-24T14:00:00-03:00",
    "ip_hash": "a1b2c3..."
  }
]
```

### 2.3 Contrato do Serviço (`src/Services/InscricaoCoralService.php`)
```php
namespace App\Services;

final class InscricaoCoralService
{
    public const LIMITE_VAGAS = 30;

    public function __construct(?string $storagePath = null);

    /**
     * Retorna o total de inscrições confirmadas e vagas restantes.
     * @return array{total: int, limite: int, restantes: int, esgotado: bool}
     */
    public function getStatusVagas(): array;

    /**
     * Tenta registrar uma nova inscrição de forma atômica com flock.
     * @param array<string, mixed> $dados
     * @return array{sucesso: bool, erros: array<string, string>, inscricao?: array<string, mixed>}
     */
    public function inscrever(array $dados): array;
}
```

### 2.4 Contrato do Controller (`src/Controllers/CoralNatalController.php`)
```php
namespace App\Controllers;

final class CoralNatalController
{
    public function __construct(?InscricaoCoralService $service = null, ?BladeViewRenderer $renderer = null);

    public function index(): void;
    public function inscrever(): void;
}
```

---

## 3. Casos de Borda & Falhas (Edge Cases)

1. **Tentativa de Inscrição Após Limite de 30 Vagas:**
   - O `InscricaoCoralService` deve bloquear a escrita dentro do lock de arquivo e retornar erro de validação `"vagas_esgotadas"`. A interface exibe aviso de vagas preenchidas e link para lista de espera no WhatsApp.
2. **Submissões Simultâneas (Concorrência):**
   - O lock exclusivo (`flock($fp, LOCK_EX)`) garante que duas requisições simultâneas não ultrapassem o limite de 30 vagas.
3. **Idade Fora da Faixa (menor que 5 ou maior que 12 anos):**
   - Retorno imediato de erro específico: `"A idade da criança deve estar entre 5 e 12 anos."`
4. **Tentativa de Ataque XSS ou Injeção:**
   - Sanitização de todos os campos com `htmlspecialchars(strip_tags(trim($valor)))`.
5. **Telefone Inválido:**
   - Validação regex garantindo no mínimo 10 dígitos numéricos (com DDD).

---

## 4. Critérios de Aceitação & Plano de Verificação (Checklist TDD)

- [ ] **1. Testes Automatizados (Fase RED):**
  - `tests/Unit/InscricaoCoralServiceTest.php`:
    - Validação de status inicial (30 vagas restantes, 0 preenchidas).
    - Validação de sucesso no cadastro e incremento do número da vaga.
    - Validação de rejeição para idade fora da faixa (< 5 ou > 12 anos).
    - Validação de rejeição para campos obrigatórios vazios ou inválidos.
    - Validação de bloqueio estrito ao atingir 30 inscrições (limite).
  - `tests/Feature/CoralNatalTest.php`:
    - Rota `GET /coral-natal` responde HTTP 200 e renderiza formulário, contador de vagas e contextualização de Guapó.
    - Rota `POST /coral-natal/inscrever` responde com confirmação de sucesso para payload válido.
    - Rota `POST /coral-natal/inscrever` responde com erros de validação para payload inválido.
- [ ] **2. Implementação do Código (Fase GREEN):**
  - Implementar `App\Services\InscricaoCoralService`.
  - Implementar `App\Controllers\CoralNatalController`.
  - Registrar rotas em `public/index.php`.
  - Criar view `views/pages/coral-natal.blade.php` com foto local `public/assets/images/coral-natal-criancas.jpg`, formulário, FAQ e botão do WhatsApp.
  - Adicionar link de divulgação em `views/pages/acao-social.blade.php`.
- [ ] **3. Validação de Regressão e Acessibilidade:**
  - 100% dos testes do PHPUnit aprovados.
  - Auditoria WCAG executada com sucesso.
