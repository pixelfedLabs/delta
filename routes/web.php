<?php
Route::domain(config('delta.domain.join'))->group(function() {
	Route::get('/', 'InstanceController@index')->name('instances.all');

	Route::get('/instance/{domain}', 'InstanceController@show');

	Route::group(['prefix' => 'api/v1'], function() {
		Route::get('instance/{domain}/timeline', 'ApiController@instanceTimeline');
		Route::get('instance/{domain}', 'ApiController@instance');
		Route::get('instances', 'ApiController@instances');
	});
});

// Route::domain(config('delta.domain.landing'))->group(function() {
// 	Route::get('/', 'SiteController@welcome');
// 	Route::get('join', 'SiteController@join');
// });