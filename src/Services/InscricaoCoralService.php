<?php

declare(strict_types=1);

namespace App\Services;

final class InscricaoCoralService
{
    public const LIMITE_VAGAS = 30;

    private string $storageFile;

    public function __construct(?string $storageFile = null)
    {
        $this->storageFile = $storageFile ?? dirname(__DIR__, 2) . '/storage/data/inscricoes_coral_natal.json';
        
        $dir = dirname($this->storageFile);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    /**
     * Retorna o status atual de vagas.
     *
     * @return array{total: int, limite: int, restantes: int, esgotado: bool}
     */
    public function getStatusVagas(): array
    {
        $inscricoes = $this->carregarInscricoes();
        $total = count($inscricoes);
        $limite = self::LIMITE_VAGAS;
        $restantes = max(0, $limite - $total);

        return [
            'total' => $total,
            'limite' => $limite,
            'restantes' => $restantes,
            'esgotado' => $total >= $limite,
        ];
    }

    /**
     * Tenta registrar uma nova inscrição garantindo integridade e concorrência com flock.
     *
     * @param array<string, mixed> $dados
     * @return array{sucesso: bool, erros: array<string, string>, inscricao?: array<string, mixed>}
     */
    public function inscrever(array $dados): array
    {
        $erros = $this->validar($dados);
        if (!empty($erros)) {
            return [
                'sucesso' => false,
                'erros' => $erros,
            ];
        }

        $fp = fopen($this->storageFile, 'c+');
        if ($fp === false) {
            return [
                'sucesso' => false,
                'erros' => ['geral' => 'Erro interno ao processar inscrição. Tente novamente ou entre em contato pelo WhatsApp.'],
            ];
        }

        flock($fp, LOCK_EX);

        try {
            $tamanho = filesize($this->storageFile);
            $conteudo = ($tamanho !== false && $tamanho > 0) ? (string) fread($fp, $tamanho) : '[]';
            $inscricoes = json_decode($conteudo, true);
            if (!is_array($inscricoes)) {
                $inscricoes = [];
            }

            if (count($inscricoes) >= self::LIMITE_VAGAS) {
                return [
                    'sucesso' => false,
                    'erros' => ['geral' => 'As 30 vagas disponíveis para o Coral de Natal foram esgotadas. Entre em contato pelo WhatsApp para lista de espera.'],
                ];
            }

            $numeroVaga = count($inscricoes) + 1;
            $novaInscricao = [
                'id' => sprintf('coral-2026-%04d', $numeroVaga),
                'numero_vaga' => $numeroVaga,
                'nome_crianca' => htmlspecialchars(strip_tags(trim((string) $dados['nome_crianca']))),
                'idade_crianca' => (int) $dados['idade_crianca'],
                'nome_responsavel' => htmlspecialchars(strip_tags(trim((string) $dados['nome_responsavel']))),
                'telefone_responsavel' => htmlspecialchars(strip_tags(trim((string) $dados['telefone_responsavel']))),
                'observacoes' => isset($dados['observacoes']) ? htmlspecialchars(strip_tags(trim((string) $dados['observacoes']))) : '',
                'criado_em' => date('c'),
            ];

            $inscricoes[] = $novaInscricao;

            ftruncate($fp, 0);
            rewind($fp);
            fwrite($fp, (string) json_encode($inscricoes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            fflush($fp);

            return [
                'sucesso' => true,
                'erros' => [],
                'inscricao' => $novaInscricao,
            ];
        } finally {
            flock($fp, LOCK_UN);
            fclose($fp);
        }
    }

    /**
     * Valida os campos enviados.
     *
     * @param array<string, mixed> $dados
     * @return array<string, string>
     */
    private function validar(array $dados): array
    {
        $erros = [];

        $nomeCrianca = trim((string) ($dados['nome_crianca'] ?? ''));
        if (mb_strlen($nomeCrianca) < 3 || mb_strlen($nomeCrianca) > 100) {
            $erros['nome_crianca'] = 'O nome da criança é obrigatório e deve ter entre 3 e 100 caracteres.';
        }

        $idadeRaw = $dados['idade_crianca'] ?? '';
        if ($idadeRaw === '' || !is_numeric($idadeRaw)) {
            $erros['idade_crianca'] = 'A idade da criança é obrigatória.';
        } else {
            $idade = (int) $idadeRaw;
            if ($idade < 5 || $idade > 12) {
                $erros['idade_crianca'] = 'A oficina é destinada a crianças com idade entre 5 e 12 anos.';
            }
        }

        $nomeResp = trim((string) ($dados['nome_responsavel'] ?? ''));
        if (mb_strlen($nomeResp) < 3 || mb_strlen($nomeResp) > 100) {
            $erros['nome_responsavel'] = 'O nome do responsável é obrigatório e deve ter entre 3 e 100 caracteres.';
        }

        $telefone = preg_replace('/\D/', '', (string) ($dados['telefone_responsavel'] ?? ''));
        if ($telefone === null || strlen($telefone) < 10 || strlen($telefone) > 11) {
            $erros['telefone_responsavel'] = 'Informe um número de WhatsApp válido com DDD (ex: 62 98765-4321).';
        }

        return $erros;
    }

    /**
     * Carrega todas as inscrições já gravadas.
     *
     * @return array<int, array<string, mixed>>
     */
    private function carregarInscricoes(): array
    {
        if (!file_exists($this->storageFile)) {
            return [];
        }

        $conteudo = (string) file_get_contents($this->storageFile);
        $dados = json_decode($conteudo, true);

        return is_array($dados) ? $dados : [];
    }
}
