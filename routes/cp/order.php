<?php 
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Order
Route::group([], function () {
	Route::get('/new-order', 							['as' => 'new-order', 			'uses' => 'OrderController@newOder']);
	Route::get('/all-order', 							['as' => 'all-order', 			'uses' => 'OrderController@allOder']);
	
	Route::get('/order-form', 							['as' => 'order-form', 			'uses' => 'OrderController@orderForm']);
	Route::get('/search-product', 							['as' => 'search-product', 		'uses' => 'OrderController@searchProduct']);
	Route::get('/search-customer', 							['as' => 'search-customer', 		'uses' => 'OrderController@searchCustomer']);
	Route::delete('/{id}', 								['as' => 'trash', 				'uses' => 'OrderController@trash']);
	Route::get('/order-data', 							['as' => 'order-data', 			'uses' => 'OrderController@orderData']);

	Route::post('/add-to-cart', 							['as' => 'add-to-cart', 		'uses' => 'OrderController@addToCart']);
	Route::get('/clear-cart', 							['as' => 'clear-cart', 		'uses' => 'OrderController@clearCart']);
	
	Route::post('/remove-item', 							['as' => 'remove-item', 		'uses' => 'OrderController@removeItem']);

	Route::get('/order-session', 							['as' => 'order-session', 		'uses' => 'OrderController@orderSession']);

	Route::post('/add-new-customer', 							['as' => 'add-new-customer', 		'uses' => 'OrderController@addNewCustomer']);

	Route::post('/add-to-cart-db', 							['as' => 'add-to-cart-db', 		'uses' => 'OrderController@addToCartDB']);
});	