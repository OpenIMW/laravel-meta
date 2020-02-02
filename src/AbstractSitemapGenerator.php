<?php
namespace IMW\LaravelSeo;

use IMW\LaravelSeo\Contracts\SitemapGenerator;

abstract class AbstractSitemapGenerator implements SitemapGenerator
{

	# Images in sitemap file
	protected $images = false;

	# Videos in sitemap file
	protected $videos = false;

	# Sitemap name
	protected $name = 'example.xml';

	/**
	 * Generate files
	 * @param Melbahja\Seo\Interfaces\SitemapBuilderInterface $map
	 * @return void
	 */
	abstract public function generate($map): void;
}

