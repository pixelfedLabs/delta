<?php
Route::domain(config('delta.domain.join'))->group(function() {
	Route::get('/', 'InstanceController@index')->name('instances.all');
	Route::group(['prefix' => 'api/v1'], function() {
		Route::get('instances', 'ApiController@instances');
	});
});
Route::domain(config('delta.domain.landing'))->group(function() {
	Route::get('/', 'SiteController@welcome');
	Route::get('join', 'SiteController@join');
});