<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\Apartment\StoreApartmentDTO;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

final class ApartmentService
{
    public private(set) ?Apartment $lastCreated = null;

    /**
     * @param array{block: ?string, number: string, parking_spot_limit: ?int} $data
     * @throws Throwable
     */
    public function createForUser(StoreApartmentDTO $storeApartmentDTO): Apartment
    {
        return DB::transaction(function () use ($storeApartmentDTO): Apartment {
            $apartment = Apartment::create([
                'block' => $storeApartmentDTO->block,
                'number' => $storeApartmentDTO->number,
                'parking_spot_limit' => $storeApartmentDTO->parkingSpotLimit,
            ]);

            $this->lastCreated = $apartment;

            return $apartment;
        });
    }
}
