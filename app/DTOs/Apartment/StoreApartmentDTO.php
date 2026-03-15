<?php

declare(strict_types=1);

namespace App\DTOs\Apartment;

readonly class StoreApartmentDTO
{
    public function __construct(
        public string $block,
        public string $number,
        public int $parkingSpotLimit,
    ) {}
}