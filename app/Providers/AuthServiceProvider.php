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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        // Auth gates for:
        Gate::define('can_creator', function ($user) {
            return in_array($user->role_id, [1]);
        });
        
        Gate::define('can_all', function ($user) {
            return in_array($user->role_id, [1, 0]);
        });

        // Auth gates for: 
        Gate::define('can_admin', function ($user) {
            return in_array($user->role_id, [0]);
        });

        // Auth gates for: 
        Gate::define('can_user', function ($user) {
            return in_array($user->role_id, [2]);
        });
    }
}
