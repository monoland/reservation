<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pricelist;
use Illuminate\Auth\Access\HandlesAuthorization;

class PricelistPolicy
{
    use HandlesAuthorization;

    /**
     * filter function
     *
     * @param [type] $user
     * @param [type] $ability
     * @return void
     */
    public function before($user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the pricelist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pricelist  $pricelist
     * @return mixed
     */
    public function view(User $user, Pricelist $pricelist)
    {
        //
    }

    /**
     * Determine whether the user can view the pricelist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pricelist  $pricelist
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can create pricelists.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can update the pricelist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pricelist  $pricelist
     * @return mixed
     */
    public function update(User $user, Pricelist $pricelist)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can delete the pricelist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pricelist  $pricelist
     * @return mixed
     */
    public function delete(User $user, Pricelist $pricelist)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can restore the pricelist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pricelist  $pricelist
     * @return mixed
     */
    public function restore(User $user, Pricelist $pricelist)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the pricelist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pricelist  $pricelist
     * @return mixed
     */
    public function forceDelete(User $user, Pricelist $pricelist)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the pricelist.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pricelist  $pricelist
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
