<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Controllers\CoralNatalController;
use App\Services\InscricaoCoralService;
use PHPUnit\Framework\TestCase;

final class CoralNatalTest extends TestCase
{
    private string $tempStorageFile;
    private InscricaoCoralService $service;
    private CoralNatalController $controller;

    protected function setUp(): void
    {
        $this->tempStorageFile = sys_get_temp_dir() . '/inscricoes_coral_feature_' . uniqid('', true) . '.json';
        $this->service = new InscricaoCoralService($this->tempStorageFile);
        $this->controller = new CoralNatalController($this->service);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->tempStorageFile)) {
            @unlink($this->tempStorageFile);
        }
    }

    public function testCoralNatalIndexRendersPageSuccessfully(): void
    {
        ob_start();
        $this->controller->index();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('Coral de Natal', $output);
        $this->assertStringContainsString('30 vagas', $output);
        $this->assertStringContainsString('Desenvolvimento Infantil', $output);
        $this->assertStringContainsString('Guapó', $output);
        $this->assertStringContainsString('banda marcial', mb_strtolower($output));
        $this->assertStringContainsString('5 a 12 anos', $output);
        $this->assertStringContainsString('nome_crianca', $output);
        $this->assertStringContainsString('nome_responsavel', $output);
        $this->assertStringContainsString('telefone_responsavel', $output);
    }

    public function testCoralNatalInscreverSuccess(): void
    {
        $_POST = [
            'nome_crianca' => 'Ana Beatriz Lima',
            'idade_crianca' => '7',
            'nome_responsavel' => 'Carlos Lima',
            'telefone_responsavel' => '62991234567',
            'observacoes' => 'Sem restrições',
        ];

        ob_start();
        $this->controller->inscrever();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('Inscrição Realizada com Sucesso', $output);
        $this->assertStringContainsString('Ana Beatriz Lima', $output);
        $this->assertStringContainsString('Vaga', $output);
        $this->assertStringContainsString('wa.me', $output);
    }

    public function testCoralNatalInscreverValidationErrors(): void
    {
        $_POST = [
            'nome_crianca' => '',
            'idade_crianca' => '2', // menor que 5
            'nome_responsavel' => '',
            'telefone_responsavel' => '123',
        ];

        ob_start();
        $this->controller->inscrever();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertStringContainsString('Preencha corretamente', $output);
    }
}
