<?php

namespace Mwk\FeatureFlags;

use Mwk\FeatureFlags\FeatureManager;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Mwk\FeatureFlags\Adapters\FeatureAdapter;
use Mwk\FeatureFlags\Adapters\ArrayFeatureAdapter;

class FeatureFlagsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('feature-flags.php'),
            ], 'config');

            // Publishing the migrations.
            $this->publishes([
                __DIR__.'/../migrations/' => database_path('migrations/'),
            ], 'features-migration');
        }

        // Register blade directives.
        Blade::if('feature', function (string $feature) {
            return app(FeatureManager::class)->feature($feature)->enabled();
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'feature-flags');

        $this->app->bind(FeatureAdapter::class, static function () {
            $adapter = config('feature-flags.adapter');
            return new $adapter(config('feature-flags.features'));
        });


        $this->app->singleton('feature-manager', function () {
            return new FeatureManager($this->app->get(FeatureAdapter::class));
        });
    }
}
