<?php

declare(strict_types=1);

namespace App\Services;

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
    public function createForUser(User $user, array $data): Apartment
    {
        return DB::transaction(function () use ($user, $data): Apartment {
            $apartment = $user->apartments()->create([
                'block' => $data['block'] ?? null,
                'number' => $data['number'],
                'parking_spot_limit' => $data['parking_spot_limit'] ?? 1,
            ]);

            $this->lastCreated = $apartment;

            return $apartment;
        });
    }
}
