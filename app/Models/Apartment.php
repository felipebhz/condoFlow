<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;


class Apartment extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::addGlobalScope('condominium', function (Builder $builder) {
            if (!Auth::check()) {
                return;
            }
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $builder->where('condominium_id', $user->condominium_id);
        });
    }

    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }

}
