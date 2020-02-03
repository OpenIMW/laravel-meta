<?php
namespace IMW\LaravelMeta;


abstract class AbstractMetaGenerator implements Contracts\MetaGenerator
{

	protected $meta = '';

	/**
	 * Create metatags and schema
	 *
	 * @param  array  $options
	 * @param  mixed  $context
	 * @return self
	 */
	public function meta(array $options, $context = null): self
	{
		$this->meta = Meta::fromArray($options, $context);
		return $this;
	}

	/**
	 * Get Metatags and schema string
	 *
	 * @return string
	 */
	public function toString(): string
	{
		return $this->meta;
	}


	abstract public function generate($context): string;
}
