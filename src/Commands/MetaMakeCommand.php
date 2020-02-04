<?php

namespace IMW\LaravelMeta\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MetaMakeCommand extends GeneratorCommand
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:meta';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Meta Generator';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Meta';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		if (parent::handle() === false && !$this->option('force')) {
			return false;
		}
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return __DIR__ . '/../../stubs/meta.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\\Seo';
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['force', null, InputOption::VALUE_NONE, 'Create the class even if the meta generator already exists'],
		];
	}
}
