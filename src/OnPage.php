<?php
namespace IMW\LaravelSeo;

class OnPage
{

	public static function build($context): string
	{
		$config = config('seo.onpage');
		$builder = $config[$context] ?? null;

		if (is_object($context)) {

			if (method_exists($context, 'buildOnPage')) return $context->buildOnPage();

			$builder = $config[$context::class] ?? null;
		}

		if (! $builder) {

			return "";
		}

		return (new $builder())->build($context);
	}
}
