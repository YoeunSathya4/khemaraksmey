<?php 
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Menu
Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'MenuController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'MenuController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'MenuController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'MenuController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'MenuController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'MenuController@trash']);
	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'MenuController@updateStatus']);

	Route::get('/get-category', 		['as' => 'get-category', 			'uses' => 'MenuController@getCategory']);

	Route::get('/{id}/categories', 					['as' => 'categories', 				'uses' => 'MenuController@categories']);
	Route::get('/categories-and-menus/check', 	['as' => 'check-categories', 			'uses' => 'MenuController@check']);
	
	Route::get('/{id}/size', 				['as' => 'size', 			'uses' => 'MenuController@sizes']);
	Route::get('/{id}/size/create', 		['as' => 'create-size', 	'uses' => 'MenuController@createSize']);
	Route::put('/size/store', 				['as' => 'store-size', 		'uses' => 'MenuController@storeSize']);
	Route::get('/{id}/size/{size_id}', 	['as' => 'edit-size', 		'uses' => 'MenuController@editSize']);
	Route::post('/{id}/size/update', 		['as' => 'update-size', 	'uses' => 'MenuController@updateSize']);
	Route::post('/{id}/size/update-size-status',['as' => 'update-size-status', 	'uses' => 'MenuController@updateSizeStatus']);
	Route::delete('size/{id}', 			['as' => 'trash-size', 		'uses' => 'MenuController@trashSize']);


	Route::group(['as' => 'image.'], function () {
		Route::get('/{id}/menu/images', 				['as' => 'index', 			'uses' => 'ImageController@index']);
		Route::get('/{id}/menu/images/create', 			['as' => 'create', 			'uses' => 'ImageController@create']);
		Route::put('/menu/images', 						['as' => 'store', 			'uses' => 'ImageController@store']);
		Route::get('/{id}/menu/images/{image_id}', 		['as' => 'edit', 			'uses' => 'ImageController@edit']);
		Route::post('/menu/images', 					['as' => 'update', 			'uses' => 'ImageController@update']);
		Route::delete('/menu/images/{image_id}', 		['as' => 'trash', 			'uses' => 'ImageController@trash']);
	});
});	