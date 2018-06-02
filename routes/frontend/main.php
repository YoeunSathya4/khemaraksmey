<?php
Route::get('{locale}/home', 				[ 'as' => 'home',			'uses' => 'HomeController@index']);
Route::get('{locale}/restaurant', 			[ 'as' => 'restaurant',			'uses' => 'RestaurantController@index']);
Route::get('{locale}/contact', 				[ 'as' => 'contact-us',			'uses' => 'ContactController@index']);
Route::put('{locale}/submit-contact-us', 		[ 'as' => 'submit-contact',			'uses' => 'ContactUsController@submitContact']);
Route::put('{locale}/submit-newsletter', 		[ 'as' => 'submit-newsletter',			'uses' => 'FrontendController@submitNewsletter']);