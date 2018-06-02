<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Featurte
Route::group([], function () {
	Route::get('/', 							['as' => 'index', 			'uses' => 'SlideController@index']);
	Route::get('/{id}', 						['as' => 'edit', 			'uses' => 'SlideController@edit']);
	Route::post('/', 							['as' => 'update', 			'uses' => 'SlideController@update']);
	Route::get('/create', 						['as' => 'create', 			'uses' => 'SlideController@create']);
	Route::put('/', 							['as' => 'store', 			'uses' => 'SlideController@store']);
	Route::delete('/{id}', 						['as' => 'trash', 			'uses' => 'SlideController@trash']);
	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'SlideController@updateStatus']);
});




			