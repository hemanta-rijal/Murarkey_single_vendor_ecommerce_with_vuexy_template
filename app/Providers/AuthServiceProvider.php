<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Modules\Users\Providers\AdminUserProvider;
use Modules\Users\Providers\OperatorProvider;

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

        Auth::extend('admin', function ($app, array $config) {
            $model = $app['config']['auth.providers.admin.model'];

            return new AdminUserProvider($app['hash'], new $model);
        });

        Auth::extend('operator', function ($app, array $config) {
            $model = $app['config']['auth.providers.operator.model'];

            return new OperatorProvider($app['hash'], new $model);
        });

    }
}
