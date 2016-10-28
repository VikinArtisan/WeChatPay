<?php

namespace Vikin\WeChatPay;

use Illuminate\Support\ServiceProvider;

class WeChatPayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/WeChatConfig.php' => config_path('WeChatConfig.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/view' => resource_path('views/WeChatPay')
        ], 'view');

        $this->publishes([
            __DIR__.'/public' => public_path('WeChatPay'),
        ], 'asset');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('WeChatPay', function () {
            return new WeChatPayMain();
        });
    }
}
