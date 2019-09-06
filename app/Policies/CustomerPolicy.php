<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
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
     * Determine whether the user can view the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function view(User $user, Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isMarketing() || $user->isManager();
    }

    /**
     * Determine whether the user can create customers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isMarketing();
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function update(User $user, Customer $customer)
    {
        if ($user->isMarketing()) {
            return $customer->marketing_id === $user->userable->id;
        }

        if ($user->isManager()) {
            return $user->userable->customers()->where('customers.id', $customer->id)->count() > 0;
        }
    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function delete(User $user, Customer $customer)
    {
        if ($user->isManager()) {
            return $user->userable->customers()->where('customers.id', $customer->id)->count() > 0 && $customer->checked === false;
        }
    }

    /**
     * Determine whether the user can restore the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function restore(User $user, Customer $customer)
    {
        if ($user->isManager()) {
            return $user->userable->customers()->where('customers.id', $customer->id)->count() > 0;
        }
    }

    /**
     * Determine whether the user can permanently delete the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function forceDelete(User $user, Customer $customer)
    {
        // 
    }

    /**
     * Determine whether the user can bulk delete the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        // 
    }
}
