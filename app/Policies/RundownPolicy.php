<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rundown;
use Illuminate\Auth\Access\HandlesAuthorization;

class RundownPolicy
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
     * Determine whether the user can view the rundown.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rundown  $rundown
     * @return mixed
     */
    public function view(User $user, Rundown $rundown)
    {
        //
    }

    /**
     * Determine whether the user can view the rundown.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rundown  $rundown
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create rundowns.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the rundown.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rundown  $rundown
     * @return mixed
     */
    public function update(User $user, Rundown $rundown)
    {
        //
    }

    /**
     * Determine whether the user can delete the rundown.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rundown  $rundown
     * @return mixed
     */
    public function delete(User $user, Rundown $rundown)
    {
        //
    }

    /**
     * Determine whether the user can restore the rundown.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rundown  $rundown
     * @return mixed
     */
    public function restore(User $user, Rundown $rundown)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the rundown.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rundown  $rundown
     * @return mixed
     */
    public function forceDelete(User $user, Rundown $rundown)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the rundown.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rundown  $rundown
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
