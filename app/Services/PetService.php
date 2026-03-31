<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Apartment;
use App\Models\Pet;

class PetService
{
    public function createPet(Apartment $apartment, array $data): Pet
    {
        //return DB::transaction()
    }
}
