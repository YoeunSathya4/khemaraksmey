<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Selling Price
Route::group(['as' => 'category.',  'prefix' => 'category'], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'CategoryController@index']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'CategoryController@update']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'CategoryController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'CategoryController@trash']);
});

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Rental Price
Route::group(['as' => 'type.',  'prefix' => 'type'], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'TypeController@index']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'TypeController@update']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'TypeController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'TypeController@trash']);
});

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Rental Price
Route::group(['as' => 'location.',  'prefix' => 'location'], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'LocationController@index']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'LocationController@create']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'LocationController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'LocationController@update']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'LocationController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'LocationController@trash']);
	Route::post('/status', 			['as' => 'status', 			'uses' => 'LocationController@status']);
});

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Restaurant Type
Route::group(['as' => 'r_type.',  'prefix' => 'r_type'], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'RestaurantTypeController@index']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'RestaurantTypeController@update']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'RestaurantTypeController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'RestaurantTypeController@trash']);
});



			