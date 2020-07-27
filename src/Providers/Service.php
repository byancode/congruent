<?php

namespace Byancode\Congruent\Providers;

use Illuminate\Support\ServiceProvider;

class Service extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/congruent.php', 'congruent'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/congruent.php' => config_path('congruent.php'),
        ]);
    }
}
