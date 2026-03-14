<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

final class ApartmentPolicy
{

    public function before(User $user, string $ability): ?bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return null;
    }

    private function isFromSameCondominium(User $user, Apartment $apartment): bool
    {
        return $user->is_active && $user->condominium_id === $apartment->condominium_id;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->condominium_id !== null && $user->is_active;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Apartment $apartment): bool
    {
        return $this->isFromSameCondominium($user, $apartment);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->condominium_id !== null && $user->is_active;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Apartment $apartment): bool
    {
        return $this->isFromSameCondominium($user, $apartment);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Apartment $apartment): bool
    {
        return $this->isFromSameCondominium($user, $apartment);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Apartment $apartment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Apartment $apartment): bool
    {
        return false;
    }
}
