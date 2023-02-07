<?php

namespace Miguelmacamo\Payment;

use \Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{

    public function boot()
    {
//        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
//        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
//        $this->loadViewsFrom(__DIR__ . '/resources/views', 'imali');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

//        https://github.com/endroid/qr-code

        $this->mergeConfigFrom(
            __DIR__ . '/config/imali.php', 'imali'
        );

        $this->publishes([
            __DIR__ . '/config/imali.php' => config_path('imali.php'),
        ], 'imali-config');
        // MAIN REPOSITORY FOR TESTS

//        $this->publishes([
//            __DIR__.'/public' => public_path('vendor/imali'),
//        ], 'public');

//        $this->publishes([
//            __DIR__.'/path/to/assets' => public_path('vendor/courier'),
//        ], 'public');
    }

    public function register()
    {
//        parent::register(); // TODO: Change the autogenerated stub
    }

}
