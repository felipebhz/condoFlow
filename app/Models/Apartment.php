<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\BelongsToCondominium;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Apartment extends Model
{
    use HasFactory, BelongsToCondominium, SoftDeletes;

    protected $fillable = [
        'block',
        'number',
        'parking_spot_limit',
        //'condominium_id',
    ];

    protected $casts = [
        'parking_spot_limit' => 'int',
    ];

    public function residents(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'apartment_user')
            ->withPivot(['is_owner', 'is_active'])
            ->withTimestamps();
    }

}
