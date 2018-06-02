<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Featurte
Route::group([], function () {
	Route::get('/', 							['as' => 'index', 			'uses' => 'ProductController@index']);
	Route::get('/{id}', 						['as' => 'edit', 			'uses' => 'ProductController@edit']);
	Route::post('/', 							['as' => 'update', 			'uses' => 'ProductController@update']);
	Route::get('/create', 						['as' => 'create', 			'uses' => 'ProductController@create']);
	Route::put('/', 							['as' => 'store', 			'uses' => 'ProductController@store']);
	Route::delete('/{id}', 						['as' => 'trash', 			'uses' => 'ProductController@trash']);
	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'ProductController@updateStatus']);
	Route::get('/sub-category', 						['as' => 'get-sub-category', 			'uses' => 'ProductController@getSubCategory']);

	Route::get('/main-category', 						['as' => 'get-main-category', 			'uses' => 'ProductController@getMainCategory']);
});




			