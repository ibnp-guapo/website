<?php

declare(strict_types=1);

namespace App\Support;

final class Env
{
    /**
     * @var array<string, string>|null
     */
    private static ?array $variables = null;

    /**
     * Recupera o valor de uma variável de ambiente com suporte a fallback
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        self::ensureLoaded();

        if (isset(self::$variables[$key])) {
            return self::$variables[$key];
        }

        $val = getenv($key);
        if ($val !== false && $val !== '') {
            return (string) $val;
        }

        if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
            return (string) $_ENV[$key];
        }

        if (isset($_SERVER[$key]) && is_string($_SERVER[$key]) && $_SERVER[$key] !== '') {
            return $_SERVER[$key];
        }

        return $default;
    }

    /**
     * Carrega e analisa o arquivo .env se ainda não tiver sido carregado
     */
    private static function ensureLoaded(): void
    {
        if (self::$variables !== null) {
            return;
        }

        self::$variables = [];

        $envPath = dirname(__DIR__, 2) . '/.env';
        if (!file_exists($envPath) || !is_readable($envPath)) {
            return;
        }

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            $pos = strpos($line, '=');
            if ($pos === false) {
                continue;
            }

            $k = trim(substr($line, 0, $pos));
            $v = trim(substr($line, $pos + 1));

            // Remove aspas simples ou duplas envolventes
            if (
                (str_starts_with($v, '"') && str_ends_with($v, '"')) ||
                (str_starts_with($v, "'") && str_ends_with($v, "'"))
            ) {
                $v = substr($v, 1, -1);
            }

            self::$variables[$k] = $v;
        }
    }

    /**
     * Reinicia cache em testes
     */
    public static function reset(): void
    {
        self::$variables = null;
    }
}
