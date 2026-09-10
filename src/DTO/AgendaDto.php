<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class AgendaDto
{
    /**
     * @param array<CultoRegularDto> $cultosRegulares
     * @param array<mixed> $eventosEspeciais
     * @param array<string, string> $canais
     */
    public function __construct(
        public string $nomeOrganizacao,
        public string $sigla,
        public string $cnpj,
        public string $timezone,
        public string $enderecoCompleto,
        public array $canais,
        public array $cultosRegulares,
        public array $eventosEspeciais = []
    ) {}
}
