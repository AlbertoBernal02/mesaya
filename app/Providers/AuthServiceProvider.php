<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function (User $user) {
            // Decuelve el rol del usuario y el rol del usurio Administrador
            return $user->role && $user->role->role_name === 'Administrador';
        });

        Gate::define('isClient', function (User $user) {
            // Decuelve el rol del usuario y el rol del usurio Cliente
            return $user->role && $user->role->role_name === 'Cliente';
        });
    }
}