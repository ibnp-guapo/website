<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Validação rigorosa do arquivo de dados canônico agenda.json
 * contra as regras e especificações do JSON Schema (agenda.schema.json).
 */
final class AgendaSchemaValidationTest extends TestCase
{
    private string $agendaJsonPath;
    private string $schemaJsonPath;

    /** @var array<string, mixed> */
    private array $agendaData;

    /** @var array<string, mixed> */
    private array $schemaData;

    protected function setUp(): void
    {
        $baseDir = dirname(__DIR__, 2);
        $this->agendaJsonPath = "{$baseDir}/data/programacao/agenda.json";
        $this->schemaJsonPath = "{$baseDir}/data/programacao/agenda.schema.json";

        $this->assertFileExists($this->agendaJsonPath, 'Arquivo data/programacao/agenda.json não encontrado.');
        $this->assertFileExists($this->schemaJsonPath, 'Arquivo data/programacao/agenda.schema.json não encontrado.');

        $agendaRaw = file_get_contents($this->agendaJsonPath);
        $schemaRaw = file_get_contents($this->schemaJsonPath);

        $this->assertNotFalse($agendaRaw);
        $this->assertNotFalse($schemaRaw);

        $decodedAgenda = json_decode($agendaRaw, true);
        $decodedSchema = json_decode($schemaRaw, true);

        $this->assertIsArray($decodedAgenda, 'agenda.json deve ser um JSON válido.');
        $this->assertIsArray($decodedSchema, 'agenda.schema.json deve ser um JSON válido.');

        $this->agendaData = $decodedAgenda;
        $this->schemaData = $decodedSchema;
    }

    public function testRequiredTopLevelPropertiesArePresent(): void
    {
        $required = $this->schemaData['required'] ?? ['organizacao', 'cultosRegulares', 'eventosEspeciais'];
        foreach ($required as $prop) {
            $this->assertArrayHasKey(
                $prop,
                $this->agendaData,
                "A propriedade obrigatória '{$prop}' não está presente em agenda.json."
            );
        }
    }

    public function testOrganizacaoConformsToContract(): void
    {
        $org = $this->agendaData['organizacao'];
        $this->assertIsArray($org);

        $this->assertSame('Igreja Batista Nacional da Paz de Guapó', $org['nome'] ?? null);
        $this->assertSame('IBN da Paz de Guapó', $org['sigla'] ?? null);
        $this->assertSame('02.930.019/0001-62', $org['cnpj'] ?? null);
        $this->assertSame('America/Sao_Paulo', $org['timezone'] ?? null);
        $this->assertMatchesRegularExpression('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $org['cnpj']);

        $this->assertArrayHasKey('endereco', $org);
        $end = $org['endereco'];
        $this->assertSame('Rua Presidente Kennedy, Qd. 21, Lt. 13', $end['logradouro'] ?? null);
        $this->assertSame('Centro', $end['bairro'] ?? null);
        $this->assertSame('Guapó', $end['cidade'] ?? null);
        $this->assertSame('GO', $end['uf'] ?? null);
        $this->assertSame('75350-000', $end['cep'] ?? null);
        $this->assertMatchesRegularExpression('/^\d{5}-\d{3}$/', $end['cep']);
        $this->assertIsFloat($end['latitude']);
        $this->assertIsFloat($end['longitude']);

        $this->assertArrayHasKey('canais', $org);
        $canais = $org['canais'];
        $this->assertSame('(62) 9870-0089', $canais['telefone'] ?? null);
        $this->assertStringStartsWith('https://wa.me/', $canais['whatsapp'] ?? '');
        $this->assertStringStartsWith('https://instagram.com/', $canais['instagram'] ?? '');
        $this->assertStringStartsWith('https://youtube.com/', $canais['youtube'] ?? '');
    }

    public function testCultosRegularesConformToContract(): void
    {
        $cultos = $this->agendaData['cultosRegulares'];
        $this->assertIsArray($cultos);
        $this->assertGreaterThanOrEqual(2, count($cultos), 'Devem existir ao menos 2 cultos regulares.');

        $validDays = ['domingo', 'quarta-feira'];

        foreach ($cultos as $culto) {
            $this->assertArrayHasKey('id', $culto);
            $this->assertMatchesRegularExpression('/^[a-z0-9-]+$/', $culto['id'], 'ID do culto deve ser slug.');

            $this->assertArrayHasKey('nome', $culto);
            $this->assertNotEmpty($culto['nome']);

            $this->assertArrayHasKey('diaSemana', $culto);
            $this->assertContains($culto['diaSemana'], $validDays, "diaSemana '{$culto['diaSemana']}' deve ser domingo ou quarta-feira.");

            $this->assertArrayHasKey('horario', $culto);
            $this->assertMatchesRegularExpression('/^([01]\d|2[0-3]):[0-5]\d$/', $culto['horario'], 'Horário deve ser HH:MM.');

            $this->assertArrayHasKey('duracaoMinutos', $culto);
            $this->assertGreaterThanOrEqual(30, $culto['duracaoMinutos']);
            $this->assertLessThanOrEqual(240, $culto['duracaoMinutos']);

            $this->assertArrayHasKey('categoria', $culto);
            $this->assertNotEmpty($culto['categoria']);

            $this->assertArrayHasKey('local', $culto);
            $this->assertNotEmpty($culto['local']);

            $this->assertArrayHasKey('descricao', $culto);
            $this->assertNotEmpty($culto['descricao']);

            $this->assertArrayHasKey('transmissaoAoVivo', $culto);
            $this->assertIsBool($culto['transmissaoAoVivo']);

            $this->assertArrayHasKey('rrule', $culto);
            $this->assertStringStartsWith('FREQ=WEEKLY', $culto['rrule']);
        }
    }

    public function testEventosEspeciaisConformToContract(): void
    {
        $this->assertArrayHasKey('eventosEspeciais', $this->agendaData);
        $this->assertIsArray($this->agendaData['eventosEspeciais']);
    }
}
