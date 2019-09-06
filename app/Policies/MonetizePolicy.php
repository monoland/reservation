<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Monetize;
use Illuminate\Auth\Access\HandlesAuthorization;

class MonetizePolicy
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
     * Determine whether the user can view the monetize.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Monetize  $monetize
     * @return mixed
     */
    public function view(User $user, Monetize $monetize)
    {
        //
    }

    /**
     * Determine whether the user can view the monetize.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Monetize  $monetize
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create monetizes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the monetize.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Monetize  $monetize
     * @return mixed
     */
    public function update(User $user, Monetize $monetize)
    {
        //
    }

    /**
     * Determine whether the user can delete the monetize.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Monetize  $monetize
     * @return mixed
     */
    public function delete(User $user, Monetize $monetize)
    {
        //
    }

    /**
     * Determine whether the user can restore the monetize.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Monetize  $monetize
     * @return mixed
     */
    public function restore(User $user, Monetize $monetize)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the monetize.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Monetize  $monetize
     * @return mixed
     */
    public function forceDelete(User $user, Monetize $monetize)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the monetize.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Monetize  $monetize
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
