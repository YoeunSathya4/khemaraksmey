<?php

Route::get('list/{page}', 	['as' => 'list', 	'uses' => 'ImagesController@listData']);
Route::get('/{slug}', 	['as' => 'edit', 	'uses' => 'ImagesController@showEditForm']);
Route::post('/', 		['as' => 'update', 	'uses' => 'ImagesController@update']);
Route::post('update-status', ['as' => 'update-status', 	'uses' => 'ImagesController@updateStatus']);
