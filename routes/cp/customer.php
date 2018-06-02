<?php 
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Customer Profile
Route::group(['as' => 'profile.', 'prefix' => 'profile'], function() {
	Route::get('/', 		['as' => 'edit', 	'uses' => 'ProfileController@edit']);
	Route::post('update', 	['as' => 'update', 	'uses' => 'ProfileController@update']);
	Route::get('password', 	['as' => 'edit-password', 	'uses' => 'ProfileController@showEditPasswordFrom']);
	Route::post('password/update', 	['as' => 'update-password', 	'uses' => 'ProfileController@changePassword']);
	Route::get('logs', 				['as' => 'logs', 	'uses' => 'ProfileController@logs']);
	//Route::get('orders', 				['as' => 'orders', 	'uses' => 'ProfileController@orders']);
});

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Customer
Route::group(['as' => 'customer.',  'prefix' => 'customer'], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'CustomerController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'CustomerController@showEditForm']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'CustomerController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'CustomerController@showCreateForm']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'CustomerController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'CustomerController@destroy']);
	Route::post('/update-email', 	['as' => 'update-email', 	'uses' => 'CustomerController@updateEmail']);
	Route::post('/update-phone', 	['as' => 'update-phone', 	'uses' => 'CustomerController@updatePhone']);
	Route::post('/update-password', ['as' => 'update-password', 'uses' => 'CustomerController@updatePassword']);
	Route::get('/{id}/logs', 		['as' => 'logs', 			'uses' => 'CustomerController@logs']);
	Route::get('/{id}/orders', 		['as' => 'orders', 			'uses' => 'CustomerController@orders']);
	Route::get('/order-data', 		['as' => 'order-data', 			'uses' => 'CustomerController@orderData']);
});
