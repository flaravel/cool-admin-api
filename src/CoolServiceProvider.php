<?php

namespace Cool;

use Cool\Models\AdminUser;
use Cool\Traits\ResponseTrait as CoolResponseTrait;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Debug\ExceptionHandler;

class CoolServiceProvider extends ServiceProvider
{
    use CoolResponseTrait;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../migrations');

            $this->publishes([
                __DIR__.'/config.php' => config_path('cool.php')
            ], 'cool-admin');
            $this->publishes([
                __DIR__ . '/CoolAdminSeeder.php' => database_path('seeders/CoolAdminSeeder.php')
            ], 'cool-seeder');

        } else {
            $this->defineCoolAdminException();
        }

        $this->defineCoolAdminRoutes();
        $this->defineCoolAdminConfigureGuard();
    }


    /**
     * @return void
     */
    protected function defineCoolAdminException()
    {
        optional(app(ExceptionHandler::class))->renderable(function (ValidationException $e) {
            return $this->error($e->getMessage());
        });
    }

    /**
     * @return void
     */
    protected function defineCoolAdminRoutes()
    {
        if (app()->routesAreCached()) {
            return;
        }
        $this->loadRoutesFrom(__DIR__.'/route.php');
    }

    /**
     * @return void
     */
    protected function defineCoolAdminConfigureGuard()
    {
        $guardData = array_merge(config('auth.guards'), [
            'cool' => [
                'driver' => 'jwt',
                'provider' => 'cool_user',
            ]
        ]);

        $providersData = array_merge(config('auth.providers'), [
            'cool_user' => [
                'driver' => 'eloquent',
                'model' => AdminUser::class,
            ]
        ]);
        config(['auth.guards' => $guardData]);
        config(['auth.providers' => $providersData]);
    }
}

