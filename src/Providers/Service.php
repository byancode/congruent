<?php

namespace Byancode\Congruent\Providers;

use Illuminate\Http\Request;
use Byancode\Congruent\Signin;
use Illuminate\Support\Facades\Auth;
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
        # --------------------------------------------------------------------------        
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
        # --------------------------------------------------------------------------
        \Illuminate\Database\Eloquent\Relations\MorphOne::macro('withCurrentLocale', function() {
            return $this->orderByRaw("(
                CASE WHEN STRCMP('$locale1', `locale`) = 0 THEN 1
                WHEN STRCMP('{$parse1['language']}', `locale`) = 0 THEN 2
                WHEN STRCMP('{$parse1['language']}',  SUBSTR(`locale`,1,2)) = 0 THEN 3
                WHEN STRCMP('$locale2', `locale`) = 0 THEN 4
                WHEN STRCMP('{$parse2['language']}', `locale`) = 0 THEN 5
                WHEN STRCMP('{$parse2['language']}',  SUBSTR(`locale`,1,2)) = 0 THEN 6
                ELSE 7
                END
            ) ASC");
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
