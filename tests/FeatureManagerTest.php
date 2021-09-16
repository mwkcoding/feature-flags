<?php

namespace Mwk\FeatureFlags\Tests;

use Mwk\FeatureFlags\Feature;
use Illuminate\Support\Facades\DB;
use Mwk\FeatureFlags\FeatureManager;
use Mwk\FeatureFlags\Adapters\FeatureAdapter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mwk\FeatureFlags\Adapters\EloquentFeatureAdapter;
use Mwk\FeatureFlags\Models\Feature as ModelsFeature;

class FeatureManagerTest extends TestCase
{
    // use DatabaseMigrations;

    public function testCanGetFeatureFromConfig()
    {
        config(['feature-flags.features' => ['my-feature' => true]]);

        $this->assertInstanceOf(Feature::class, $this->manager::feature('my-feature'));
        $this->assertTrue($this->manager::feature('my-feature')->enabled());
    }

    public function testDoesNotThrowErrorOnNonExistentFeature()
    {
        $feature = 'non-existent';
        $this->assertInstanceOf(Feature::class, $this->manager::feature($feature));
        $this->assertFalse($this->manager::feature($feature)->enabled());
    }

    public function testCanCustomizeDefaultIfFeatureNotFound()
    {
        $feature = 'does-not-exist-but-is-true';
        $default = true;
        $this->assertInstanceOf(Feature::class, $this->manager::feature($feature, $default));
        $this->assertTrue($this->manager::feature($feature, $default)->enabled());
    }

    public function testCanUpdateDatabaseFeature()
    {
        $this->app->bind(FeatureAdapter::class, function() {
            return new EloquentFeatureAdapter(config('feature-flags.features'));
        });

        $slug = 'my-feature-now-with-database';

        $this->assertFalse($this->manager::feature($slug)->enabled());

        $modelsFeature = ModelsFeature::whereSlug($slug)->first();
        $modelsFeature->is_enabled = true;
        $modelsFeature->save();

        $this->assertTrue($this->manager::feature($slug)->enabled());
    }

    public function testWontCreateFeatureIfDisabledInConfig()
    {
        config(['feature-flags.create_if_not_exists' => false]);

        $this->app->bind(FeatureAdapter::class, function() {
            return new EloquentFeatureAdapter(config('feature-flags.features'));
        });

        $slug = 'my-feature-wont-exist';

        $this->assertFalse($this->manager::feature($slug)->enabled());

        $modelsFeature = ModelsFeature::whereSlug($slug)->first();

        $this->assertNull($modelsFeature);
    }

    public function testCanCreateFeatureIfNotFound()
    {
        $this->app->bind(FeatureAdapter::class, function() {
            return new EloquentFeatureAdapter(config('feature-flags.features'));
        });

        $slug = 'my-feature-now-with-database';

        $this->assertFalse($this->manager::feature($slug)->enabled());

        $modelsFeature = ModelsFeature::whereSlug($slug)->first();

        $this->assertInstanceOf(ModelsFeature::class, $modelsFeature);
    }
}
