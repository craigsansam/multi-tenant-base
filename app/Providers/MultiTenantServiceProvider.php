<?php

namespace App\Providers;

use App\Services\MultiTenantService;
use Illuminate\Support\ServiceProvider;

class MultiTenantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            $this->app->singleton('tenant', function () {
                $tenant = (new MultiTenantService())->findByHost(request()->server('HTTP_HOST'));
                return (!$tenant) ? false : $tenant;
            });
        }

        if (app()->bound('tenant') && app('tenant')) {
            config(['database.connections.mysql.database' => app('tenant')->database_name]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
