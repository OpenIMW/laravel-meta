<?php
namespace IMW\LaravelMeta;

use Illuminate\Support\Facades\Cache;

class Cache
{

	/**
	 * Get or cache item based on context
	 *
	 * @param  object|string $context
	 * @return string
	 */
	public static function get($context): string
	{
		$key = 'meta_'. (is_object($context) ? get_class($context) : $context);

		return Cache::driver(env('META_CACHE_DRIVER', config('cache.default')))
					->tags('laravel_meta')
					->remember($key, env('META_CACHE_TTL', 1296000), function() use ($context)
					{
						return Meta::generate($context, true);
					});
	}

	/**
	 * Flush cache
	 *
	 * @return void
	 */
	public static function flush(): void
	{
		Cache::driver(env('META_CACHE_DRIVER', config('cache.default')))->tags('laravel_meta')->flush();
	}

}
