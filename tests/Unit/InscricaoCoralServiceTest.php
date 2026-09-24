<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\InscricaoCoralService;
use PHPUnit\Framework\TestCase;

final class InscricaoCoralServiceTest extends TestCase
{
    private string $tempStorageFile;
    private InscricaoCoralService $service;

    protected function setUp(): void
    {
        $this->tempStorageFile = sys_get_temp_dir() . '/inscricoes_coral_test_' . uniqid('', true) . '.json';
        $this->service = new InscricaoCoralService($this->tempStorageFile);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->tempStorageFile)) {
            @unlink($this->tempStorageFile);
        }
    }

    public function testStatusVagasInicial(): void
    {
        $status = $this->service->getStatusVagas();

        $this->assertSame(0, $status['total']);
        $this->assertSame(30, $status['limite']);
        $this->assertSame(30, $status['restantes']);
        $this->assertFalse($status['esgotado']);
    }

    public function testInscricaoComDadosValidos(): void
    {
        $resultado = $this->service->inscrever([
            'nome_crianca' => 'Lucas Gabriel Silva',
            'idade_crianca' => 8,
            'nome_responsavel' => 'Mariana Silva',
            'telefone_responsavel' => '(62) 98765-4321',
            'observacoes' => 'Gosta muito de música',
        ]);

        $this->assertTrue($resultado['sucesso']);
        $this->assertEmpty($resultado['erros']);
        $this->assertArrayHasKey('inscricao', $resultado);
        $this->assertSame(1, $resultado['inscricao']['numero_vaga']);
        $this->assertSame('Lucas Gabriel Silva', $resultado['inscricao']['nome_crianca']);
        $this->assertSame(8, $resultado['inscricao']['idade_crianca']);
        $this->assertSame('Mariana Silva', $resultado['inscricao']['nome_responsavel']);
        $this->assertSame('(62) 98765-4321', $resultado['inscricao']['telefone_responsavel']);

        $status = $this->service->getStatusVagas();
        $this->assertSame(1, $status['total']);
        $this->assertSame(29, $status['restantes']);
    }

    public function testRejeicaoPorIdadeInvalida(): void
    {
        // Menor que 5 anos
        $resMenor = $this->service->inscrever([
            'nome_crianca' => 'Bebê João',
            'idade_crianca' => 4,
            'nome_responsavel' => 'Pai João',
            'telefone_responsavel' => '62987654321',
        ]);
        $this->assertFalse($resMenor['sucesso']);
        $this->assertArrayHasKey('idade_crianca', $resMenor['erros']);

        // Maior que 12 anos
        $resMaior = $this->service->inscrever([
            'nome_crianca' => 'Jovem Pedro',
            'idade_crianca' => 13,
            'nome_responsavel' => 'Pai Pedro',
            'telefone_responsavel' => '62987654321',
        ]);
        $this->assertFalse($resMaior['sucesso']);
        $this->assertArrayHasKey('idade_crianca', $resMaior['erros']);
    }

    public function testRejeicaoPorCamposObrigatoriosVazios(): void
    {
        $res = $this->service->inscrever([
            'nome_crianca' => '',
            'idade_crianca' => '',
            'nome_responsavel' => '',
            'telefone_responsavel' => '123', // telefone com poucos dígitos
        ]);

        $this->assertFalse($res['sucesso']);
        $this->assertArrayHasKey('nome_crianca', $res['erros']);
        $this->assertArrayHasKey('idade_crianca', $res['erros']);
        $this->assertArrayHasKey('nome_responsavel', $res['erros']);
        $this->assertArrayHasKey('telefone_responsavel', $res['erros']);
    }

    public function testBloqueioAoAtingirLimiteDe30Vagas(): void
    {
        // Preenche as 30 vagas no arquivo
        $inscricoesIniciais = [];
        for ($i = 1; $i <= 30; $i++) {
            $inscricoesIniciais[] = [
                'id' => sprintf('coral-2026-%04d', $i),
                'numero_vaga' => $i,
                'nome_crianca' => "Criança {$i}",
                'idade_crianca' => 8,
                'nome_responsavel' => "Responsável {$i}",
                'telefone_responsavel' => '62999999999',
                'criado_em' => date('c'),
            ];
        }
        file_put_contents($this->tempStorageFile, json_encode($inscricoesIniciais, JSON_PRETTY_PRINT));

        $status = $this->service->getStatusVagas();
        $this->assertSame(30, $status['total']);
        $this->assertSame(0, $status['restantes']);
        $this->assertTrue($status['esgotado']);

        // Tentativa de 31ª inscrição deve ser rejeitada
        $resultado = $this->service->inscrever([
            'nome_crianca' => 'Criança 31',
            'idade_crianca' => 10,
            'nome_responsavel' => 'Responsável 31',
            'telefone_responsavel' => '62988888888',
        ]);

        $this->assertFalse($resultado['sucesso']);
        $this->assertArrayHasKey('geral', $resultado['erros']);
        $this->assertStringContainsString('esgotadas', mb_strtolower($resultado['erros']['geral']));
    }
}
