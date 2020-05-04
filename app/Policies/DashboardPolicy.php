<?php

namespace App\Policies;

use App\User;
use App\Dashboard;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the dashboard.
     *
     * @param  \App\User  $user
     * @param  \App\Dashboard  $dashboard
     * @return mixed
     */
    public function view(User $user, Dashboard $dashboard)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View dashboards');
    }

    

    /**
     * Determine whether the user can update the dashboard.
     *
     * @param  \App\User  $user
     * @param  \App\Dashboard  $dashboard
     * @return mixed
     */
    public function update(User $user, Dashboard $dashboard)
    {
        //
    }

   
}
