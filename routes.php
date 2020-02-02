<?php

Route::get('/robots.txt', '\IMW\LaravelSeo\Controllers\SeoController@robots');

Route::get('/sitemap/{id}', '\IMW\LaravelSeo\Controllers\SeoController@sitemap');
