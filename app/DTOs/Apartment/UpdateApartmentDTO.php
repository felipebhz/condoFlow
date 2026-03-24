<?php

declare(strict_types=1);

namespace App\DTOs\Apartment;

readonly class UpdateApartmentDTO
{
    public function __construct(
        public string $block,
        public string $number,
        public int $parkingSpotLimit,
    ) {}
}