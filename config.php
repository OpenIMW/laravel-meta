<?php

return
[

	'factoryOptions' =>
	[
		'index_name' => 'index.xml',
		'save_path' => public_path('/sitemaps'),
		'sitemaps_url' => config('app.url') . '/sitemaps'
	]

	'sitemaps' =>
	[
		'\App\Sitemap\ExampleGenerator',
	],

	# Sitemaps compression
	'gzip' => false,

	# Add disallowed urls to robots.txt
	'disallow' =>
	[
		'*' => ['/excludeed'],
	]
];
