<?php

namespace Acacha\Scool\Staff\Providers;

use Acacha\Scool\Staff\Facades\ScoolStaff;
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

        //Publish
        $this->publishViews();

        $this->publishSeeds();

        //Loading
        $this->loadMigrations();

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

    /**
     * Publish package views to Laravel project.
     */
    private function publishViews()
    {
        $this->loadViewsFrom(SCOOLSTAFF_PATH.'/resources/views/', 'acacha_scool_staff');

        $this->publishes(ScoolStaff::views(), 'acacha_scool_staff');
    }

    /**
     * Load package migrations.
     */
    public function loadMigrations()
    {
        $this->loadMigrationsFrom(SCOOLSTAFF_PATH .'/database/migrations');
    }

    /**
     * Publish seeds.
     */
    private function publishSeeds() {
        $this->publishes(ScoolStaff::seeds(), 'acacha_scool_staff');
    }
}
