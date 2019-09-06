<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Regency;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegencyPolicy
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
        if ($user->isAdministrator() || $user->isManager()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the regency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Regency  $regency
     * @return mixed
     */
    public function view(User $user, Regency $regency)
    {
        //
    }

    /**
     * Determine whether the user can view the regency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Regency  $regency
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create regencies.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the regency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Regency  $regency
     * @return mixed
     */
    public function update(User $user, Regency $regency)
    {
        //
    }

    /**
     * Determine whether the user can delete the regency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Regency  $regency
     * @return mixed
     */
    public function delete(User $user, Regency $regency)
    {
        //
    }

    /**
     * Determine whether the user can restore the regency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Regency  $regency
     * @return mixed
     */
    public function restore(User $user, Regency $regency)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the regency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Regency  $regency
     * @return mixed
     */
    public function forceDelete(User $user, Regency $regency)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the regency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Regency  $regency
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
