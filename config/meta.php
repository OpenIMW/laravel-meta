<?php

return
[
	'home' => 'App\Seo\Home',

	'App\Models\Product' =>
	[
		'title|og:title|twitter:title' => 'name',
		'description|twitter:description|og:description' => 'description',
		'schema' =>
		[
			[
				'@type' => 'BreadcrumbList',
				'itemListElement' =>
				[
					[
						'@type' => 'ListItem',
						'position' => 1,
						'name' => 'Products',
						'item' => '/products'
					],
					[
						'@type' => 'ListItem',
						'position' => 2,
						'name' => 'name',
						'item' => '/products/path'
					],
				]
			]
		]
	],

	'App\Models\Book' => 'App\Seo\Book'
];
