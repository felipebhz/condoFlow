<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Condominium extends Model
{

    protected $table = 'condominiums';
    
    use HasFactory;

    protected $guarded = [];

    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
