<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Featurte
Route::group([], function () {
	Route::get('/', 							['as' => 'index', 			'uses' => 'AnnouncementController@index']);
	Route::get('/{id}', 						['as' => 'edit', 			'uses' => 'AnnouncementController@edit']);
	Route::post('/', 							['as' => 'update', 			'uses' => 'AnnouncementController@update']);
	Route::get('/create', 						['as' => 'create', 			'uses' => 'AnnouncementController@create']);
	Route::put('/', 							['as' => 'store', 			'uses' => 'AnnouncementController@store']);
	Route::delete('/{id}', 						['as' => 'trash', 			'uses' => 'AnnouncementController@trash']);
	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'AnnouncementController@updateStatus']);
});




			