<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Marketing;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketingPolicy
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
     * Determine whether the user can view the marketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Marketing  $marketing
     * @return mixed
     */
    public function view(User $user, Marketing $marketing)
    {
        //
    }

    /**
     * Determine whether the user can view the marketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Marketing  $marketing
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create marketings.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the marketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Marketing  $marketing
     * @return mixed
     */
    public function update(User $user, Marketing $marketing)
    {
        //
    }

    /**
     * Determine whether the user can delete the marketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Marketing  $marketing
     * @return mixed
     */
    public function delete(User $user, Marketing $marketing)
    {
        //
    }

    /**
     * Determine whether the user can restore the marketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Marketing  $marketing
     * @return mixed
     */
    public function restore(User $user, Marketing $marketing)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the marketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Marketing  $marketing
     * @return mixed
     */
    public function forceDelete(User $user, Marketing $marketing)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the marketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Marketing  $marketing
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
