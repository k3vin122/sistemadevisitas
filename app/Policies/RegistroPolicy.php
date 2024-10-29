<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Registro;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistroPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the registro can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list registros');
    }

    /**
     * Determine whether the registro can view the model.
     */
    public function view(User $user, Registro $model): bool
    {
        return $user->hasPermissionTo('view registros');
    }

    /**
     * Determine whether the registro can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create registros');
    }

    /**
     * Determine whether the registro can update the model.
     */
    public function update(User $user, Registro $model): bool
    {
        return $user->hasPermissionTo('update registros');
    }

    /**
     * Determine whether the registro can delete the model.
     */
    public function delete(User $user, Registro $model): bool
    {
        return $user->hasPermissionTo('delete registros');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete registros');
    }

    /**
     * Determine whether the registro can restore the model.
     */
    public function restore(User $user, Registro $model): bool
    {
        return false;
    }

    /**
     * Determine whether the registro can permanently delete the model.
     */
    public function forceDelete(User $user, Registro $model): bool
    {
        return false;
    }
}
