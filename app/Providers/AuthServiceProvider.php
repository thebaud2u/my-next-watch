<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return null|boolean
     */
    public function boot()
    {
        $this->registerPolicies();

        // Laravel-Permission
        // Implicitly grant "Super Admin" role all permission checks using auth()->user->can() and @can()
        // @see https://spatie.be/docs/laravel-permission/v5/basic-usage/super-admin#content-gatebefore
        Gate::before(function ($user, $ability) {
            // Using current user (User|Admin) guard
            // @see https://stackoverflow.com/a/50709289
            // @see https://laravel.com/api/7.x/Illuminate/Auth/AuthManager.html#method_getDefaultDriver
            if($user->hasRole('superadmin', Auth::getDefaultDriver())) {
                return true;
            }
            return null;
        });
    }
}
