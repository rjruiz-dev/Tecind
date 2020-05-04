<?php

namespace App\Policies;

use App\User;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuditPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the audit.
     *
     * @param  \App\User  $user
     * @param  \OwenIt\Auditing\Models\Audit  $audit
     * @return mixed
     */
    public function view(User $user, Audit $audit)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View audits');
    }

    /**
     * Determine whether the user can create audits.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    // public function create(User $user)
    // {
    //     //
    // }

    /**
     * Determine whether the user can update the audit.
     *
     * @param  \App\User  $user
     * @param  \OwenIt\Auditing\Models\Audit  $audit
     * @return mixed
     */
    // public function update(User $user, Audit $audit)
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the audit.
     *
     * @param  \App\User  $user
     * @param  \OwenIt\Auditing\Models\Audit  $audit
     * @return mixed
     */
    // public function delete(User $user, Audit $audit)
    // {
    //     //
    // }

    /**
     * Determine whether the user can restore the audit.
     *
     * @param  \App\User  $user
     * @param  \OwenIt\Auditing\Models\Audit  $audit
     * @return mixed
     */
    // public function restore(User $user, Audit $audit)
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the audit.
     *
     * @param  \App\User  $user
     * @param  \OwenIt\Auditing\Models\Audit  $audit
     * @return mixed
     */
    // public function forceDelete(User $user, Audit $audit)
    // {
    //     //
    // }
}
