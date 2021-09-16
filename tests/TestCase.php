<?php

namespace Mwk\FeatureFlags\Tests;

use Mwk\FeatureFlags\FeatureFlagsServiceProvider;
use Mwk\FeatureFlags\FeatureManager;
use Mwk\FeatureFlags\FeatureManagerFacade;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $manager;

    /**
     * Ignore package discovery from.
     *
     * @return array
     */
    public function ignorePackageDiscoveriesFrom()
    {
        return [];
    }

    protected function getPackageProviders($app)
    {
        return [FeatureFlagsServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        # Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback', ['--database' => 'testbench'])->run();
        });
    }

    protected function setUp(): void
    {
        parent::setUp();

        // $status = $this->artisan('migrate:fresh', [
        //     '--force' => true,
        //     '--database' => 'testbench',
        //     '--realpath' => realpath(__DIR__.'/../migrations'),
        // ])->run();

        // $this->loadLaravelMigrations(['--database' => 'testbench']);
        // $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        $this->manager = FeatureManagerFacade::class;
    }
}
