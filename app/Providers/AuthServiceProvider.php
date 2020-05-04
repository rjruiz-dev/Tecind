<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Post'                              => 'App\Policies\PostPolicy',
        'App\Time'                              => 'App\Policies\TimePolicy',
        'App\User'                              => 'App\Policies\UserPolicy',
        'App\Dashboard'                         => 'App\Policies\DashboardPolicy',
        'Spatie\Permission\Models\Role'         => 'App\Policies\RolePolicy',
        'OwenIt\Auditing\Models\Audit'          => 'App\Policies\AuditPolicy',
        'App\Piece'                             => 'App\Policies\PiecePolicy',          
        'App\Order'                             => 'App\Policies\OrderPolicy',      
        'App\Client'                            => 'App\Policies\ClientPolicy',
        'Spatie\Permission\Models\Permission'   => 'App\Policies\PermissionPolicy',    
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
