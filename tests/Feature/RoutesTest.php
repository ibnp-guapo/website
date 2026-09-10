<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

final class RoutesTest extends TestCase
{
    public function testIndexPhpSyntaxIsValid(): void
    {
        $indexFile = __DIR__ . '/../../public/index.php';
        $this->assertFileExists($indexFile);
        
        $output = [];
        $returnVar = 0;
        exec("php -l \"{$indexFile}\"", $output, $returnVar);
        
        $this->assertSame(0, $returnVar, 'Syntax error detected in public/index.php: ' . implode("\n", $output));
    }

    public function testPublicDirectoryStructure(): void
    {
        $this->assertFileExists(__DIR__ . '/../../public/index.php');
        $this->assertFileExists(__DIR__ . '/../../public/assets/css/app.css');
        $this->assertFileExists(__DIR__ . '/../../public/assets/css/input.css');
    }
}
