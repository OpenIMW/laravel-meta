# Larevel Meta

Basic on-page search engine optimization (SEO) for Laravel applications.

## Install

#### 1 - Install The Package:
Run: `composer require imw/laravel-meta`
#### 2 - Add Laravel Meta Provider.
Open: `config/app.php` and put `IMW\LaravelMeta\MetaServiceProvider::class` in providers.
#### 3 - Publish Laravel Meta Config.
Run: `php artisan vendor:publish --tag=config --provider="IMW\LaravelMeta\MetaServiceProvider"`

## Usage

#### Using meta.php config

You need to define your meta by a key to be able to use it later in your blade template.

```php
<?php
return
[
	'home' =>
	[
		'title|og:title|twitter:title' => 'Home page',
		'description|twitter:description|og:description' => 'Home description',
		'schema' =>
		[
			[
				"@type" => "Organization",
				"url" => "http://www.example.com",
				"logo" => "http://www.example.com/images/logo.png"
			],
			[
				'@type' => 'BreadcrumbList',
				'itemListElement' =>
				[
					[
						'@type' => 'ListItem',
						'position' => 1,
						'name' => 'Home Page',
						'item' => 'http://www.example.com'
					]
				]
			]
		]
	],

	'App\Book' => 'App\Seo\Book'
];
```
In blade template all you need to do is calling the meta directive:
```
@meta('home')
```
this directive will generate these results:
```html
<meta name="title" content="Home page">
<meta property="og:title" content="Home page" />
<meta name="twitter:title" content="Home page">
<meta name="description" content="Home description">
<meta name="twitter:description" content="Home description">
<meta property="og:description" content="Home description" />
<script type="application/ld+json">
[
	{
		"@type": "Organization",
		"url": "http:\/\/www.example.com",
		"logo": "http:\/\/www.example.com\/images\/logo.png",
		"@context": "https:\/\/schema.org"
	},
	{
		"@type": "BreadcrumbList",
		"itemListElement": [
			{
				"@type": "ListItem",
				"position": "1",
				"name": "Home Page",
				"item": "http:\/\/www.example.com"
			}
		],
		"@context": "https:\/\/schema.org"
	}
]
</script>
```
#### Using model properties and generators.

Instead of generating tags from config you can use the generator, This may help in complex schemas and large applications.

Run `php artisan make:meta Book` this will generate a class in `app/Seo`, then you can define your metatags and schema there like:

```php
<?php
namespace App\Seo;

use IMW\LaravelMeta\AbstractMetaGenerator;

class Book extends AbstractMetaGenerator
{

	public function generate($book): string
	{
		$this->meta(
		[
			'title' => $book->name,
			'description' => $book->description,
			'schema' =>
			[
				[
					'@type' => 'BreadcrumbList',
					'itemListElement' =>
					[
						[
							'@type' => 'ListItem',
							'position' => 1,
							'name' => 'Books',
							'item' => 'http://www.example.com/books'
						],
						[
							'@type' => 'ListItem',
							'position' => 2,
							'name' => $book->name,
							'item' => 'http://www.example.com/books/1'
						]
					]
				]
			]
		]);

		return $this->toString();
	}
}
```
In Book Blade file:

```
@meta($book)
```

The Results:
```html
<meta name="title" content="Book name">
<meta name="description" content="Book description from model">
<script type="application/ld+json">
[
{
	"@type": "BreadcrumbList",
	"itemListElement":
	[
		{
			"@type": "ListItem",
			"position": "1",
			"name": "Books",
			"item": "http:\/\/www.example.com\/books"
		},
		{
			"@type": "ListItem",
			"position": "2",
			"name": "Book name",
			"item": "http:\/\/www.example.com\/books\/1"
		}
	],
	"@context": "https:\/\/schema.org"
}
]
</script>
```

