<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    //GateContract $gate
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user){
            return $user->hasRole('administrator');
        });
        Gate::define('isStaff', function($user){
            return $user->hasRole('staff');
        });
        Gate::define('isHr', function($user){
            return $user->hasRole('hr');
        });
        Gate::define('isStudent', function($user){
            return $user->hasRole('student');
        });
    }
}
