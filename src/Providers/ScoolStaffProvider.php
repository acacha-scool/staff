<?php

namespace Acacha\Scool\Staff\Providers;

use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Support\ServiceProvider;

/**
 * Class ScoolStaffProvider.
 *
 * @package Acacha\Scool\Staff\Providers
 */
class ScoolStaffProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->defineRoutes();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (!defined('SCOOLSTAFF_PATH')) {
            define('SCOOLSTAFF_PATH', realpath(__DIR__.'/../../'));
        }

        $this->app->bind('ScoolStaff', function () {
            return new \Acacha\Scool\Staff\ScoolStaff();
        });
    }

    /**
     * Define the Staff package routes.
     */
    protected function defineRoutes()
    {
        if (!$this->app->routesAreCached()) {
            $router = app('router');

            $router->group(['namespace' => 'Acacha\Scool\Staff\Http\Controllers'], function () {
                require __DIR__.'/../Http/routes.php';
            });
        }
    }
}
