<?php

	//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Auth
	Route::group(['as' => 'auth.', 'prefix' => 'auth', 'namespace' => 'Auth'], function(){	
		require(__DIR__.'/auth.php');
	});
	
	//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Authensicated
	Route::group(['middleware' => 'authenticatedUser'], function() {
		Route::group(['as' => 'user.',  'prefix' => 'user', 'namespace' => 'User'], function () {
			require(__DIR__.'/user.php');
		});

		
		//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Setup
		Route::group(['as' => 'setup.', 'prefix' => 'setup', 'namespace' => 'Setup'], function () {
			require(__DIR__.'/setup.php');
		});
		//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Restaurant
		Route::group(['as' => 'restaurant.', 'prefix' => 'restaurant', 'namespace' => 'Restaurant'], function () {
			require(__DIR__.'/restaurant.php');
		});
		Route::group(['as' => 'menu.',  'prefix' => 'menu', 'namespace' => 'Menu'], function () {
			require(__DIR__.'/menu.php');
		});
		Route::group(['as' => 'customer.',  'prefix' => 'customer', 'namespace' => 'Customer'], function () {
			require(__DIR__.'/customer.php');
		});
		Route::group(['as' => 'order.',  'prefix' => 'order', 'namespace' => 'Order'], function () {
			require(__DIR__.'/order.php');
		});
		//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Slide
		Route::group(['as' => 'slide.', 'prefix' => 'slide', 'namespace' => 'Slide'], function () {
			require(__DIR__.'/slide.php');
		});

		//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> News
		Route::group(['as' => 'news.', 'prefix' => 'news', 'namespace' => 'News'], function () {
			require(__DIR__.'/news.php');
		});
		//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Promotion
		Route::group(['as' => 'promotion.', 'prefix' => 'promotion', 'namespace' => 'Promotion'], function () {
			require(__DIR__.'/promotion.php');
		});
		//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Announcement
		Route::group(['as' => 'announcement.', 'prefix' => 'announcement', 'namespace' => 'Announcement'], function () {
			require(__DIR__.'/announcement.php');
		});

		//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Category
		Route::group(['as' => 'category.', 'prefix' => 'category', 'namespace' => 'Category'], function () {
			require(__DIR__.'/category.php');
		});

		//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Category
		Route::group(['as' => 'product.', 'prefix' => 'product', 'namespace' => 'Product'], function () {
			require(__DIR__.'/product.php');
		});
	});