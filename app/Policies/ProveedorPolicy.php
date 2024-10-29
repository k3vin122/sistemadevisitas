<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Proveedor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProveedorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the proveedor can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list proveedors');
    }

    /**
     * Determine whether the proveedor can view the model.
     */
    public function view(User $user, Proveedor $model): bool
    {
        return $user->hasPermissionTo('view proveedors');
    }

    /**
     * Determine whether the proveedor can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create proveedors');
    }

    /**
     * Determine whether the proveedor can update the model.
     */
    public function update(User $user, Proveedor $model): bool
    {
        return $user->hasPermissionTo('update proveedors');
    }

    /**
     * Determine whether the proveedor can delete the model.
     */
    public function delete(User $user, Proveedor $model): bool
    {
        return $user->hasPermissionTo('delete proveedors');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete proveedors');
    }

    /**
     * Determine whether the proveedor can restore the model.
     */
    public function restore(User $user, Proveedor $model): bool
    {
        return false;
    }

    /**
     * Determine whether the proveedor can permanently delete the model.
     */
    public function forceDelete(User $user, Proveedor $model): bool
    {
        return false;
    }
}
