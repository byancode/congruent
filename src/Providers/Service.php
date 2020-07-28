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
        ], 'config');
        # ----------------        
        \Illuminate\Database\Schema\Blueprint::macro('customMorphs', function(string $name, array $options = []) {
            $this->integer("{$name}_id", $options['integer'] ?? 10);
            $this->string ("{$name}_type", $options['string'] ?? 100);
            # -----------------------------
            if (isset($options['index'])) {
                $this->index([
                    "{$name}_id",
                    "{$name}_type",
                ], $options['index']);
            }
            # -----------------------------
            return $this;
        });
    }
    

    /**
     * Checks if the config is valid.
     *
     * @param  array|null $config the package configuration
     * @throws InvalidConfiguration exception or null
     * @see  \Byancode\Congruent\Exceptions\InvalidConfiguration
     */
    protected function guardAgainstInvalidConfiguration(array $config = null)
    {
        // Here you can add as many checks as your package config needed to
        // consider it valid.
        // @see \Me\MyPackage\Exceptions\InvalidConfiguration
        if (empty($config['version'])) {
            //throw InvalidConfiguration::versionNotSpecified();
        }
    }

    /**
     * Check if package is running under Lumen app.
     *
     * @return bool
     */
    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen') === true;
    }
}
