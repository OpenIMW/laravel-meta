<?php

namespace IMW\LaravelMeta\Tests;

use IMW\LaravelMeta\MetaServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // $this->loadMigrationsFrom([
        //     '--database' => 'testing',
        //     '--path' => realpath('tests/migrations'),
        // ]);

        // $this->withFactories(realpath('tests/factories'));
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('meta', include(__DIR__.'/../config/meta.php'));
    }

	/**
	 * @param \Illuminate\Foundation\Application $app
	 * @return array
	 */
    protected function getPackageProviders($app)
    {
        return [
			MetaServiceProvider::class,
        ];
    }
}
