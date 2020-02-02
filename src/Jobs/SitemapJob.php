<?php
namespace IMW\laravelSeo\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class SitemapsJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	* The number of times the job may be attempted.
	*
	* @var int
	*/
	public $tries = 2;


	 /**
	 * Execute the job.
	 *
	 * // SitemapsJob::dispatch()
	 * // SitemapsJob::dispatch('products') to create or update only products sitemaps file
	 *
	 * @return void
	 */
	public function handle(string $name = null)
	{
		if (null === $name) {

			$this->generateAll();

			return;
		}

		$this->gererateByName($name);
	}


	public function generateAll()
	{
		// generate all sitemap files
	}


	public function gererateByName(string $name)
	{

	}

}