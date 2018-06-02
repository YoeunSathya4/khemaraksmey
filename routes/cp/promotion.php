<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Featurte
Route::group([], function () {
	Route::get('/', 							['as' => 'index', 			'uses' => 'PromotionController@index']);
	Route::get('/{id}', 						['as' => 'edit', 			'uses' => 'PromotionController@edit']);
	Route::post('/', 							['as' => 'update', 			'uses' => 'PromotionController@update']);
	Route::get('/create', 						['as' => 'create', 			'uses' => 'PromotionController@create']);
	Route::put('/', 							['as' => 'store', 			'uses' => 'PromotionController@store']);
	Route::delete('/{id}', 						['as' => 'trash', 			'uses' => 'PromotionController@trash']);
	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'PromotionController@updateStatus']);
});




			