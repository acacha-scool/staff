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

    use DetectsApplicationNamespace;


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

//        if ($this->app->runningInConsole()) {
//            $this->commands([\Acacha\AdminLTETemplateLaravel\Console\PublishAdminLTE::class]);
//        }

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

            $router->group(['namespace' => $this->getAppNamespace().'Http\Controllers'], function () {
                require __DIR__.'/../Http/routes.php';
            });
        }
    }
}
