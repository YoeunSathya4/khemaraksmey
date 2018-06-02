<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Frontend
Route::get('/', function () {
	    return Redirect::intended('en/home');
});

Route::group(['namespace' => 'Frontend'], function () {

	require(__DIR__.'/frontend/main.php');

});


//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Control Panel
Route::group(['as' => 'cp.', 'prefix' => 'cp', 'namespace' => 'CP'], function() {
	require(__DIR__.'/cp/main.php');
});

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Control Panel
Route::group(['as' => 'customer.', 'prefix' => 'customer', 'namespace' => 'Customer'], function() {
	require(__DIR__.'/customer/main.php');
});