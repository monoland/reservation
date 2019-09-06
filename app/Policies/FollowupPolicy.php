<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Followup;
use Illuminate\Auth\Access\HandlesAuthorization;

class FollowupPolicy
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
     * Determine whether the user can view the followup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Followup  $followup
     * @return mixed
     */
    public function view(User $user, Followup $followup)
    {
        //
    }

    /**
     * Determine whether the user can view the followup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Followup  $followup
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create followups.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the followup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Followup  $followup
     * @return mixed
     */
    public function update(User $user, Followup $followup)
    {
        //
    }

    /**
     * Determine whether the user can delete the followup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Followup  $followup
     * @return mixed
     */
    public function delete(User $user, Followup $followup)
    {
        //
    }

    /**
     * Determine whether the user can restore the followup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Followup  $followup
     * @return mixed
     */
    public function restore(User $user, Followup $followup)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the followup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Followup  $followup
     * @return mixed
     */
    public function forceDelete(User $user, Followup $followup)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the followup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Followup  $followup
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
