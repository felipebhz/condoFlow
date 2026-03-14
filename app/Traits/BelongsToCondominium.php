<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Condominium;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait BelongsToCondominium
{
    public static function bootBelongsToCondominium(): void
    {
        static::addGlobalScope('condominium', function (Builder $builder) {
            if (!Auth::check()) {
                return;
            }

            /** @var \App\Models\User $user */
            $user = Auth::user();
            
            if ($user->condominium_id) {
                $builder->where('condominium_id', $user->condominium_id);
            }
        });
    }

    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }
}
