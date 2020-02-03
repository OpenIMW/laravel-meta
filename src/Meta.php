<?php

namespace IMW\LaravelMeta;

use Illuminate\Support\Arr;

class Meta
{
    public static function generate($context, bool $skipCache = false): string
    {
        // Get meta tags from cache, and avoiding generate tags on each request
        if (config('metacache.driver') && $skipCache === false) {
            return Cache::get($context);
        }

        $config = config('meta');

        if (is_object($context)) {
            if (method_exists($context, 'generateMeta')) {
                return $context->generateMeta();
            }

            $options = $config[get_class($context)] ?? null;
        } else {
            $options = $config[$context] ?? null;
        }

        if (!$options) {
            return '';
        } elseif (is_array($options)) {
            return static::fromArray($options, $context);
        } elseif (is_string($options) && class_exists($options)) {
            $generator = new $options();

            return $generator->generate($context);
        }

        throw new MetaException('Context most be an class name or array.');
    }

    /**
     * Build metatags and schema from options.
     *
     * @param array $options
     * @param mixed $context
     *
     * @return string
     */
    public static function fromArray(array $options, $context): string
    {
        $schema = null;

        if (isset($options['schema'])) {
            $schema = static::schemaFromArray($options['schema'], $context);

            unset($options['schema']);
        }

        $tags = static::tagsFromArray($options, $context);

        if ($schema !== null) {
            $tags .= '<script type="application/ld+json">'.$schema.'</script>';
        }

        return $tags;
    }

    /**
     * Build tags form array.
     *
     * @param array $options
     * @param mixed $context
     *
     * @return string
     */
    public static function tagsFromArray(array $options, $context): string
    {
        $tags = '';

        foreach ($options as $option => $value) {
            $option = explode('|', $option);

            foreach ($option as $key) {
                switch (true) {
                    case starts_with($key, 'og:'):
                        $tag = '<meta property=":k" content=":v" />';
                        break 1;

                    default:
                        $tag = '<meta name=":k" content=":v">';
                }

                $tags .= str_replace(
                    [':k', ':v'],
                    [$key, e(static::getFromContext($context, $value))],
                    $tag
                );
            }
        }

        return $tags;
    }

    /**
     * Get schema json from array.
     *
     * @param array $schema
     * @param mixed $context
     *
     * @return string
     */
    public static function schemaFromArray($schema, $context): string
    {
        foreach ($schema as $k => $values) {
            $schema[$k] = static::schemaGetFromContext($context, $values, function ($val) use (&$context) {
                return static::getFromContext($context, $val);
            });

            $schema[$k]['@context'] = 'https://schema.org';
        }

        return json_encode($schema, JSON_PRETTY_PRINT);
    }

    /**
     * Get value by key from context.
     *
     * @param mixed  $context
     * @param string $value
     *
     * @return string
     */
    public static function getFromContext($context, $value): string
    {
        $val = null;

        if ($value[0] === '\\') {
            return substr($value, 1);
        } elseif (is_array($context)) {
            $val = Arr::get($context, $value);
        } elseif (is_object($context)) {
            $val = $context->$value;
        }

        return $val ?? $value;
    }

    /**
     * Schema get from context.
     *
     * @param mixed    $context
     * @param array    $values
     * @param \Closure $call
     *
     * @return string
     */
    public static function schemaGetFromContext($context, array $values, \Closure $call): array
    {
        $fn = function ($val) use (&$fn, &$call) {
            if (is_array($val)) {
                return array_map($fn, $val);
            }

            return $call($val);
        };

        return array_map($fn, $values);
    }
}
