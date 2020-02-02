<?php
namespace IMW\LaravelSeo\Contracts;


interface SitemapGenerator
{

	public function generate($map): void;
}
