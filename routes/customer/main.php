<?php

	Route::get('not-allow', 		['as' => 'not-allow', 					'uses' => 'AccessController@showUnaccessForm']);// Not allow to access
	Route::get('{locale}/login', 			['as' => 'login', 						'uses' => 'LoginController@showLoginForm']);// Check if seeker has login, if not, display login form
	Route::post('{locale}/login', 			['as' => 'authenticate', 				'uses' => 'LoginController@login']);//Check database using username and password
	Route::get('{locale}/forgot-password', 	['as' => 'forgot-password', 			'uses' => 'ForgotPasswordController@showLinkRequestForm']);//display forgot password form
	Route::post('{locale}/forgot-password', 	['as' => 'make-forgot-password-code', 	'uses' => 'ForgotPasswordController@sendResetLinkEmail']); //Get an Email from user and compare to database
	
	Route::get('{locale}/reset-password/{token}', 	['as' => 'reset-password', 				'uses' => 'ResetPasswordController@showResetForm']); //After verify the code, a form of reseting new password is here
	Route::post('{locale}/password/reset', 			['as' => 'reset', 						'uses' => 'ResetPasswordController@reset']); // Get new password from the form and change


	Route::get('{locale}/logout', 			['as' => 'logout', 						'uses' => 'LoginController@logout']);//Logout from system
	
	Route::get('{locale}/register', 			[ 'as' => 'register',				'uses' => 'RegisterController@showRegisterForm']);
	Route::post('{locale}/register', 			[ 'as' => 'register',					'uses' => 'RegisterController@register']);

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Authensicated
// Route::group(['middleware' => 'authenticatedUser'], function() {
	Route::get('{locale}/profile', 			[ 'as' => 'profile',			'uses' => 'ProfileXController@index']);
	//Route::post('{locale}/profile', 		[ 'as' => 'profile',			'uses' => 'ProfileController@updqte']);
	Route::post('/', 						['as' => 'update', 			'uses' => 'ProfileXController@update']);
// });

	Route::get('{locale}/order', 			[ 'as' => 'order',			'uses' => 'OrderController@index']);
	//Route::post('{locale}/profile', 		[ 'as' => 'profile',			'uses' => 'ProfileController@updqte']);