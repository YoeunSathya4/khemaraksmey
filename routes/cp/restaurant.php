<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Featurte
Route::group([], function () {
	Route::get('/', 							['as' => 'index', 			'uses' => 'RestaurantController@index']);
	Route::get('/{id}', 						['as' => 'edit', 			'uses' => 'RestaurantController@edit']);
	Route::post('/', 							['as' => 'update', 			'uses' => 'RestaurantController@update']);
	Route::get('/create', 						['as' => 'create', 			'uses' => 'RestaurantController@create']);
	Route::put('/', 							['as' => 'store', 			'uses' => 'RestaurantController@store']);
	Route::delete('/{id}', 						['as' => 'trash', 			'uses' => 'RestaurantController@trash']);
	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'RestaurantController@updateStatus']);
	Route::get('/{id}/categories', 				['as' => 'categories', 		'uses' => 'RestaurantController@categories']);
	Route::put('/store-category', 				['as' => 'store-category', 			'uses' => 'RestaurantController@storeCategory']);
	Route::get('/getcategories', 				['as' => 'get-categories', 	'uses' => 'RestaurantController@getCategories']);
	Route::get('/{id}/selected', 				['as' => 'selected', 		'uses' => 'RestaurantController@selected']);

	Route::put('/add', 							['as' => 'add', 			'uses' => 'RestaurantController@add']);
	Route::DELETE('/remove', 					['as' => 'remove', 			'uses' => 'RestaurantController@remove']);
	Route::get('/{id}/contact', 				['as' => 'contact', 		'uses' => 'RestaurantController@contact']);
	Route::post('/update-contact', 				['as' => 'update-contact', 	'uses' => 'RestaurantController@updateContact']);

	



	Route::group(['as' => 'menu.'], function () {
		Route::get('/{id}/restaurant/menu', 				['as' => 'index', 			'uses' => 'MenuController@index']);
		Route::get('/{id}/restaurant/menu/create', 			['as' => 'create', 			'uses' => 'MenuController@create']);
		Route::put('/restaurant/menu', 						['as' => 'store', 			'uses' => 'MenuController@store']);
		Route::get('/{id}/restaurant/menu/{menu_id}', 		['as' => 'edit', 			'uses' => 'MenuController@edit']);
		Route::post('/restaurant/menu', 					['as' => 'update', 			'uses' => 'MenuController@update']);
		Route::delete('/restaurant/menu/{menu_id}', 		['as' => 'trash', 			'uses' => 'MenuController@trash']);
		Route::post('/restaurant/menu/update-status', 		['as' => 'update-menu-status', 	'uses' => 'MenuController@updateStatus']);

		Route::get('/{restaurant_id}/size/{menu_id}', 				['as' => 'size', 	'uses' => 'MenuController@sizes']);
		Route::get('/{restaurant_id}/size/{menu_id}/create', 		['as' => 'create-size', 	'uses' => 'MenuController@createSize']);
		Route::put('/size/store', 				['as' => 'store-size', 		'uses' => 'MenuController@storeSize']);
		Route::get('/{restaurant_id}/size/{menu_id}/{size_id}', 		['as' => 'edit-size', 		'uses' => 'MenuController@editSize']);
		Route::post('/{id}/size/update', 		['as' => 'update-size', 	'uses' => 'MenuController@updateSize']);
		Route::post('/{id}/size/update-status',	['as' => 'update-status', 	'uses' => 'MenuController@updateSizeStatus']);
		Route::delete('size/{id}', 				['as' => 'trash-size', 		'uses' => 'MenuController@trashSize']);


		Route::get('/{restaurant_id}/extra/{menu_id}', 				['as' => 'extra', 	'uses' => 'MenuController@extras']);
		Route::get('/{restaurant_id}/extra/{menu_id}/create', 		['as' => 'create-extra', 	'uses' => 'MenuController@createExtra']);
		Route::put('/extra/store', 									['as' => 'store-extra', 		'uses' => 'MenuController@storeExtra']);
		Route::get('/{restaurant_id}/extra/{menu_id}/{size_id}', 	['as' => 'edit-extra', 		'uses' => 'MenuController@editExtra']);
		Route::post('/{id}/extra/update', 							['as' => 'update-extra', 	'uses' => 'MenuController@updateExtra']);
		Route::post('/{id}/extra/update-status',					['as' => 'update-status', 	'uses' => 'MenuController@updateExtraStatus']);
		Route::delete('extra/{id}', 								['as' => 'trash-extra', 		'uses' => 'MenuController@trashExtra']);
	});


});




			