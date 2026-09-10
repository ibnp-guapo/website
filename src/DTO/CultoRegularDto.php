<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class CultoRegularDto
{
    public function __construct(
        public string $id,
        public string $diaSemana,
        public string $horario,
        public int $duracaoMinutos,
        public string $nome,
        public string $categoria,
        public string $local,
        public string $descricao,
        public bool $transmissaoAoVivo = false,
        public ?string $canalTransmissao = null,
        public string $rrule = ''
    ) {}

    /**
     * Retorna o horário final calculado a partir de duracaoMinutos
     */
    public function getHorarioFim(): string
    {
        $parts = explode(':', $this->horario);
        $totalMinutes = ((int) $parts[0] * 60) + (int) ($parts[1] ?? 0) + $this->duracaoMinutos;
        $endHours = (int) floor($totalMinutes / 60) % 24;
        $endMins = $totalMinutes % 60;

        return sprintf('%02d:%02d', $endHours, $endMins);
    }
}
