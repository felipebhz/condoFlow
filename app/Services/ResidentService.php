<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ResidentService
{
    public function attachResident(Apartment $apartment, int $userId, bool $isOwner)
    {
        $user = User::findOrFail($userId);

        if ($apartment->residents()->where('user_id', $userId)->exists()) {
            abort(409, 'Este usuário já é um morador ativo deste apartamento.');
        }

        DB::transaction(function () use ($apartment, $user, $isOwner) {
            $apartment->residents()->attach($user->id, [
                'is_owner' => $isOwner,
                'is_active' => true,
                ]);
        });

        $user->assignRole('morador');
    }
}