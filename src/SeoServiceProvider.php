<?php
namespace IMW\LaravelSeo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class SeoServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		if ($this->app->runningInConsole()) {

			$this->commands([Commands\SitemapMakerCommand::class]);
		}

		$this->publishes(
		[
			dirname(__DIR__) .'/config.php' => config_path('seo.php'),
		]);

		$this->loadRoutesFrom(dirname(__DIR__) .'/routes.php');

		Blade::directive('seo', function($expr)
		{
			//
			// Parse expr and pass options to OnPage::build
			//
			// Generate meta tags
			// @seo([
			// 	'title' => 'somthing',
			// 	'description' => 'Page description'
			// 	'schema' => [$product]
			// ])
			//

		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{

	}
}
