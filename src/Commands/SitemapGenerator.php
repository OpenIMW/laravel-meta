<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SitemapMakerCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'sitemap:make {name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Make new sitemap generator class.';


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		// create new file in App/Sitemap/{name}.php
	}
}
