<?php

namespace App\Models;

use App\Enums\PetSize;
use App\Enums\PetSpecies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    /** @use HasFactory<\Database\Factories\PetFactory> */
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'name',
        'size',
        'breed',
        'species',
        'photo_path'
    ];

    public function casts(): array
    {
        return [
            'species' => PetSpecies::class,
            'size' => PetSize::class,
        ];
    }

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

}
