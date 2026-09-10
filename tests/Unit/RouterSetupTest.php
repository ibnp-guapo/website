<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

final class RouterSetupTest extends TestCase
{
    public function testCanonicalAgendaFileExists(): void
    {
        $agendaPath = __DIR__ . '/../../data/programacao/agenda.json';
        $this->assertFileExists($agendaPath);
        
        $data = json_decode((string) file_get_contents($agendaPath), true);
        $this->assertIsArray($data);
        $this->assertSame('Igreja Batista Nacional da Paz de Guapó', $data['organizacao']['nome']);
        $this->assertCount(2, $data['cultosRegulares']);
    }

    public function testCanonicalEstatutoFileExists(): void
    {
        $xmlPath = __DIR__ . '/../../data/legal/estatuto-social.akn.xml';
        $this->assertFileExists($xmlPath);
        
        $xml = simplexml_load_file($xmlPath);
        $this->assertNotFalse($xml);
        $this->assertSame('akomaNtoso', $xml->getName());
    }

    public function testPublicAssetsCssExists(): void
    {
        $cssPath = __DIR__ . '/../../public/assets/css/app.css';
        $this->assertFileExists($cssPath);
        $this->assertGreaterThan(1000, filesize($cssPath));
    }
}
