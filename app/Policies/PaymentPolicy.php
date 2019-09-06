<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
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
     * Determine whether the user can view the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function view(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can view the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create payments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function update(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can delete the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function delete(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can restore the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function restore(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function forceDelete(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the payment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
