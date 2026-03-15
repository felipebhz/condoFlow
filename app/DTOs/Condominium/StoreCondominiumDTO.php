<?php

declare(strict_types=1);

namespace App\DTOs\Condominium;

readonly class StoreCondominiumDTO
{
    public function __construct(
        public string $name,
        public string $taxId,
        public ?string $address,
    ) {}
}
