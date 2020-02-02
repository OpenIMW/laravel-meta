<?php

return
[

	'factoryOptions' =>
	[
		'index_name' => 'index.xml',
		'save_path' => public_path('/sitemaps'),
		'sitemaps_url' => config('app.url') . '/sitemaps'
	],

	'sitemaps' =>
	[
		'example' => '\App\Sitemap\ExampleGenerator',
	],

	'onpage' =>
	[
		'home' => 'App\Seo\Home',

		'App\Models\Product' => 'App\Seo\Product',
	],

	# Sitemaps compression
	'gzip' => false,

	# Add disallowed urls to robots.txt
	'disallow' =>
	[
		'*' => ['/excluded'],
	]
];
