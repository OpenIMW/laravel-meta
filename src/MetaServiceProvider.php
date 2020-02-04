<?php

namespace IMW\LaravelMeta;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MetaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\MetaMakeCommand::class,
            ]);
        }

        $this->publishes(
        [
            dirname(__DIR__).'/config/meta.php'  => config_path('meta.php'),
            dirname(__DIR__).'/config/cache.php' => config_path('metacache.php'),
        ], 'config');

        Blade::directive('meta', function ($expr) {
            return '<?php echo \IMW\LaravelMeta\Meta::generate('.$expr.') ?>';
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
