<?php
namespace IMW\laravelSeo;

use Melbahja\Seo\Factory;

abstract class AbstractOnPageBuilder
{

	protected $metatags = '', $schema = [];

	/**
	 * Append metatags
	 *
	 * @param  array  $options
	 * @return void
	 */
	public function meta(array $options): void
	{
		$metatags = Factory::metaTags();

		ksort($options);

		foreach ($options as $name => $val)
		{

			if (substr($name, 0, 2) === 'og:') {

				$metatags->facebook($name, $val);

			} else {

				$metatags->meta($name, $val);
			}
		}

		$this->metatags .= (string) $metatags;
	}

	/**
	 * Append or get schema class
	 *
	 * @param  string $name
	 * @param  array $options
	 * @return mixed
	 */
	public function schema(string $name, array $options = null)
	{
		$schema = Factory::schema($name);

		if (null === $options) {

			return $schema;
		}

		foreach ($options as $name => $val)
		{
			$schema->set($name, $val);
		}

		$this->schema[] = $schema;
	}

	/**
	 * Metatags and schema to string
	 *
	 * @return string
	 */
	public function toString(): string
	{
		$out = $this->metatags;

		if (false === empty($this->schema)) {

			$out .= '<script type="application/ld+json">'. json_encode($this->schema) . '</script>';
		}

		return $out;
	}
}
