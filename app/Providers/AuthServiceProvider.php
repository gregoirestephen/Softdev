<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Gate;
use Illuminate\Support\Facades\Gate as GateContract;

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

        Gate::define('isAdmin',function($user){
            return $user->profil->lib_p=='Administrateur';
        });

        Gate::define('isMedecin',function($user){
            return $user->profil->lib_p=='Medecin';
        });

        Gate::define('isSecretaire',function($user){
            return $user->profil->lib_p=='Secretaire';
        });

        Gate::define('isFantomas',function($user){
            return $user->profil->lib_p=='Fantomas1';
        });

        //
    }
}
