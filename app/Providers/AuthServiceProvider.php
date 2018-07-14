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

        Gate::define('delete-apartment', function ($user, $apartment) {
            return $user->role > 1 ? true : false;
        });
        
        Gate::define('store-apartment', function ($user) {
            return $user->role > 1 ? true : false;
        });
        
        Gate::define('deleteNote-apartment', function ($user, $apartment) {
            return $user->id == $note->user_id and $user->role > 1 ? true : false;
        });
    }
}
