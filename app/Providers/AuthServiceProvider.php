<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
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

        Gate::define('is-student', function($user){
            
            return $user->hasAnyRole('Student');
            
        });

        Gate::define('is-superadmin', function($user){
            
            return $user->hasAnyRole('Super Admin');
            
        });

        Gate::define('is-ojtcoordinator', function($user){
            
            return $user->hasAnyRole('OJT Coordinator');
            
        });

        Gate::define('is-adviser', function($user){
            
            return $user->hasAnyRole('Adviser');
            
        });
    }
}
