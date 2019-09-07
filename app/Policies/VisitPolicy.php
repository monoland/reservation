<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visit;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitPolicy
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
     * Determine whether the user can view the visit.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Visit  $visit
     * @return mixed
     */
    public function view(User $user, Visit $visit)
    {
        //
    }

    /**
     * Determine whether the user can view the visit.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Visit  $visit
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create visits.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the visit.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Visit  $visit
     * @return mixed
     */
    public function update(User $user, Visit $visit)
    {
        //
    }

    /**
     * Determine whether the user can delete the visit.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Visit  $visit
     * @return mixed
     */
    public function delete(User $user, Visit $visit)
    {
        //
    }

    /**
     * Determine whether the user can restore the visit.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Visit  $visit
     * @return mixed
     */
    public function restore(User $user, Visit $visit)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the visit.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Visit  $visit
     * @return mixed
     */
    public function forceDelete(User $user, Visit $visit)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the visit.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Visit  $visit
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
