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
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('super_admin',function($user){
            return $user->isSuperAdmin('super_admin');
        });

        Gate::define('editor',function($user){
            return $user->hasAnyRole('editor');
        });

        Gate::define('treasurer',function($user){
            return $user->hasAnyRole('editor');
        });

        Gate::define('secretary',function($user){
            return $user->hasAnyRole('secretary');
        });

    }
}
