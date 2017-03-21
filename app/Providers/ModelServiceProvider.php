<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('AccountModel','App\Model\Account');
        $this->app->bind('UserModel','App\Model\User');
    }


    public function provides()
    {
        return [
            'AccountModel',
            'UserModel',
        ];
    }
}
