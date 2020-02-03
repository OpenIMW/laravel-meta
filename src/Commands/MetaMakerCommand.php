<?php
namespace IMW\LaravelMeta\Commands;

use Illuminate\Console\Command;

class MetaMakerCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'make:meta {name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Make new meta tags and schema class.';


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$name = $this->argument('name');
		$class = app_path("Seo/{$name}.php");

		if (file_exists($class)) {

			$this->error("{$class} already exists");
			return;
		}

		if (! is_dir(dirname($class))) {

			mkdir(dirname($class));
		}

		file_put_contents(
			$class,
			str_replace('{name}', $name, file_get_contents(dirname(__DIR__, 2) . '/stubs/meta.stub'))
		);
	}
}
