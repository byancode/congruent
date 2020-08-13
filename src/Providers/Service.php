<?php

namespace Byancode\Congruent\Providers;

use Illuminate\Http\Request;
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
        $this->defineMacros();
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

    protected function defineMacros()
    {
        
        # --------------------------------------------------------------------------        
        \Illuminate\Database\Schema\Blueprint::macro('customMorphs', function(string $name, int $string = 100, int $integer = 10) {
            $id = $this->unsignedBigInteger("{$name}_id", $integer);
            $type = $this->string("{$name}_type", $string);
            # -----------------------------
            return new class($this, $name, compact('id', 'type')) {
                var $table;
                var $field;
                var $morph;

                function __construct($table, $field, $morph)
                {
                    $this->table = $table;
                    $this->field = $field;
                    $this->morph = $morph;
                }
                public function nullable(bool $value = true)
                {
                    $this->morph['id']->nullable($value);
                    $this->morph['type']->nullable($value);
                    return $this;
                }
                public function column(string $type, string $name)
                {
                    $name = $name ?? $this->field;
                    return \call_user_func([$this->table, $type], [
                        "{$this->field}_id",
                        "{$this->field}_type",
                    ],  "{$name}_{$type}");
                }
                public function index(string $name = null)
                {
                    return $this->column('index', $name);
                }
                public function unique(string $name = null)
                {
                    return $this->column('unique', $name);
                }
                public function __call(string $name , array $arguments)
                {
                    return \call_user_func_array([$this->table, $name], $arguments);
                }
            };
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
}
