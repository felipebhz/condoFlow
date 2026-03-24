<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\Apartment\StoreApartmentDTO;
use App\DTOs\Apartment\UpdateApartmentDTO;
use App\Models\Apartment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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

    public function update(Apartment $apartment, UpdateApartmentDTO $updateApartmentDTO): Apartment
    {
        return DB::transaction(function () use ($apartment, $updateApartmentDTO): Apartment {
            $apartment->update([
                'block' => $updateApartmentDTO->block,
                'number' => $updateApartmentDTO->number,
                'parking_spot_limit' => $updateApartmentDTO->parkingSpotLimit,
            ]);

            return $apartment;
        });
    }

    public function paginate(int $perPage = 8): LengthAwarePaginator
    {
        return Apartment::paginate($perPage);
    }

    public function delete(Apartment $apartment): bool
    {
        return $apartment->delete();
    }
}
