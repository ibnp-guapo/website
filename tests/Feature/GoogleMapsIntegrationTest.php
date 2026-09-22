<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Controllers\PageController;
use App\Support\Env;
use PHPUnit\Framework\TestCase;

final class GoogleMapsIntegrationTest extends TestCase
{
    private PageController $controller;

    protected function setUp(): void
    {
        $this->controller = new PageController();
    }

    public function testEnvSupportLoadsVariablesAndDefaults(): void
    {
        $this->assertTrue(class_exists(Env::class), 'A classe App\\Support\\Env deve existir.');
        
        $key = Env::get('GOOGLE_MAPS_API_KEY');
        $this->assertNotNull($key, 'GOOGLE_MAPS_API_KEY deve ser lida do ambiente ou arquivo .env.');
        $this->assertSame('AIzaSyDbEVEEZhm1QcIJqm5nZvBfeG7uprFRppY', $key);

        $defaultVal = Env::get('NON_EXISTENT_ENV_KEY_123', 'fallback_val');
        $this->assertSame('fallback_val', $defaultVal);
    }

    public function testContatoPageRendersGoogleMapComponent(): void
    {
        ob_start();
        $this->controller->contato();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        
        // Deve possuir elemento semântico de mapa com acessibilidade
        $this->assertStringContainsString('role="region"', $output);
        $this->assertStringContainsString('aria-label="Mapa de localização da Igreja Batista Nacional da Paz de Guapó"', $output);
        
        // Coordenadas canônicas do Templo Sede
        $this->assertStringContainsString('-16.8315', $output);
        $this->assertStringContainsString('-49.5317', $output);

        // Deve conter script do Google Maps com a chave de API
        $this->assertStringContainsString('maps.googleapis.com/maps/api/js', $output);
        $this->assertStringContainsString('AIzaSyDbEVEEZhm1QcIJqm5nZvBfeG7uprFRppY', $output);

        // Deve conter rota direta de navegação para aplicativos mobile
        $this->assertStringContainsString('maps.google.com/?q=', $output);
        $this->assertStringContainsString('directions', $output);
    }

    public function testHomePageRendersGoogleMapComponent(): void
    {
        ob_start();
        $this->controller->home();
        $output = (string) ob_get_clean();

        $this->assertNotEmpty($output);
        
        // Deve possuir elemento de mapa com acessibilidade
        $this->assertStringContainsString('aria-label="Mapa de localização da Igreja Batista Nacional da Paz de Guapó"', $output);
        $this->assertStringContainsString('-16.8315', $output);
        $this->assertStringContainsString('-49.5317', $output);
        $this->assertStringContainsString('maps.googleapis.com/maps/api/js', $output);
        $this->assertStringContainsString('AIzaSyDbEVEEZhm1QcIJqm5nZvBfeG7uprFRppY', $output);
    }
}
