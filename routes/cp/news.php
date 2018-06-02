<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Featurte
Route::group([], function () {
	Route::get('/', 							['as' => 'index', 			'uses' => 'NewsController@index']);
	Route::get('/{id}', 						['as' => 'edit', 			'uses' => 'NewsController@edit']);
	Route::post('/', 							['as' => 'update', 			'uses' => 'NewsController@update']);
	Route::get('/create', 						['as' => 'create', 			'uses' => 'NewsController@create']);
	Route::put('/', 							['as' => 'store', 			'uses' => 'NewsController@store']);
	Route::delete('/{id}', 						['as' => 'trash', 			'uses' => 'NewsController@trash']);
	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'NewsController@updateStatus']);
});




			