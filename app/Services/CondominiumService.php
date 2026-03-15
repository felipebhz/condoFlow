<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\Condominium\StoreCondominiumDTO;
use App\Models\Condominium;
use Illuminate\Support\Facades\DB;

class CondominiumService
{
    public private(set) ?Condominium $lastCreated = null;

    /**
     * @param array{name: ?string, taxId: string, address: ?string} $data
     * @throws Throwable
     */
    public function createForUser(StoreCondominiumDTO $storeCondominiumDTO): Condominium
    {
        return DB::transaction(function () use($storeCondominiumDTO): Condominium {
            $condominium = Condominium::create([
                'name' => $storeCondominiumDTO->name,
                'tax_id' => $storeCondominiumDTO->taxId,
                'address' => $storeCondominiumDTO->address,
            ]);

            $this->lastCreated = $condominium;

            return $condominium;
        });
    }

}
