<?php

Route::domain(config('delta.domain.app'))->group(function() {
	Route::get('/', 'AccountController@home');
	Route::redirect('dashboard', '/');
	Route::redirect('home', '/');
	Auth::routes();
});

Route::domain(config('delta.domain.landing'))->group(function() {
	Route::get('/', 'SiteController@welcome');
	Route::get('join', 'SiteController@join');
	Route::get('dashboard', 'SiteController@dashboardRedirect');
});
