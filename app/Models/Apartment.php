<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\BelongsToCondominium;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apartment extends Model
{
    use HasFactory, BelongsToCondominium;

    protected $fillable = [
        'block',
        'number',
        'parking_spot_limit',
        'condominium_id',
    ];

    protected $casts = [
        'parking_spot_limit' => 'int',
    ];
}
