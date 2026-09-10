<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

final class BladeViewRenderer
{
    private Factory $factory;

    public function __construct(string $viewsPath, string $cachePath)
    {
        $files = new Filesystem();
        $dispatcher = new Dispatcher();

        if (!is_dir($cachePath)) {
            @mkdir($cachePath, 0777, true);
        }

        // Compilador Blade oficial do Illuminate
        $bladeCompiler = new BladeCompiler($files, $cachePath);

        // Resolvers de Engine para Blade e PHP
        $resolver = new EngineResolver();
        $resolver->register('blade', fn () => new CompilerEngine($bladeCompiler, $files));
        $resolver->register('php', fn () => new PhpEngine($files));

        // Localizador de templates
        $finder = new FileViewFinder($files, [$viewsPath]);

        // Factory do View
        $this->factory = new Factory($resolver, $finder, $dispatcher);
    }

    /**
     * Renderiza um template Blade com os dados fornecidos
     *
     * @param array<string, mixed> $data
     */
    public function render(string $view, array $data = []): string
    {
        return $this->factory->make($view, $data)->render();
    }
}
