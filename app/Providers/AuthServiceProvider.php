<?php

namespace ControleDeHoras\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'ControleDeHoras\Model' => 'ControleDeHoras\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('department', function ($user, $department) {
            return $department->idAccount == $user->idAccount;
        });

        Gate::define('user', function ($user, $userV) {
            return $userV->idAccount == $user->idAccount;
        });

        Gate::define('work', function ($user, $work) {
            return $work->idAccount == $user->idAccount;
        });

        Gate::define('record', function ($user, $record) {
            return $record->work->idAccount == $user->idAccount;
        });

    }
}
