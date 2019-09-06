<?php

namespace App\Policies;

use App\Models\User;
use App\Models\District;
use Illuminate\Auth\Access\HandlesAuthorization;

class DistrictPolicy
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
     * Determine whether the user can view the district.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\District  $district
     * @return mixed
     */
    public function view(User $user, District $district)
    {
        //
    }

    /**
     * Determine whether the user can view the district.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\District  $district
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create districts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the district.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\District  $district
     * @return mixed
     */
    public function update(User $user, District $district)
    {
        //
    }

    /**
     * Determine whether the user can delete the district.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\District  $district
     * @return mixed
     */
    public function delete(User $user, District $district)
    {
        //
    }

    /**
     * Determine whether the user can restore the district.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\District  $district
     * @return mixed
     */
    public function restore(User $user, District $district)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the district.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\District  $district
     * @return mixed
     */
    public function forceDelete(User $user, District $district)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the district.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\District  $district
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
