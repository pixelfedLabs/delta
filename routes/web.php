<?php

Route::domain(config('delta.domain.app'))->group(function() {
	Route::get('/', 'AccountController@home');
	Auth::routes();
});

Route::domain(config('delta.domain.landing'))->group(function() {
	Route::get('/', 'SiteController@welcome');
	Route::get('join', 'SiteController@join');
});
