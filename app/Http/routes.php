<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get( '/', function () {
		return view( 'welcome' );
} );
Route::group( [ 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth.checkrole' ], function () {
		// Route of categories
		Route::group( [ 'prefix' => 'categories', 'as' => 'categories.' ], function () {
				Route::get( '/', [ 'as' => 'index', 'uses' => 'CategoriesController@index' ] );
				Route::get( 'create', [ 'as' => 'create', 'uses' => 'CategoriesController@create' ] );
				Route::post( 'store', [ 'as' => 'store', 'uses' => 'CategoriesController@store' ] );
				Route::get( 'edit/{id}', [ 'as' => 'edit', 'uses' => 'CategoriesController@edit' ] );
				Route::put( 'update/{id}', [ 'as' => 'update', 'uses' => 'CategoriesController@update' ] );
				Route::get( 'destroy/{id}', [ 'as' => 'destroy', 'uses' => 'CategoriesController@destroy' ] );
		} );
		// Route of clients
		Route::group( [ 'prefix' => 'clients', 'as' => 'clients.' ], function () {
				Route::get( '/', [ 'as' => 'index', 'uses' => 'ClientsController@index' ] );
				Route::get( 'create', [ 'as' => 'create', 'uses' => 'ClientsController@create' ] );
				Route::post( 'store', [ 'as' => 'store', 'uses' => 'ClientsController@store' ] );
				Route::get( 'edit/{id}', [ 'as' => 'edit', 'uses' => 'ClientsController@edit' ] );
				Route::put( 'update/{id}', [ 'as' => 'update', 'uses' => 'ClientsController@update' ] );
				Route::get( 'destroy/{id}', [ 'as' => 'destroy', 'uses' => 'ClientsController@destroy' ] );
		} );
		// Route of product
		Route::group( [ 'prefix' => 'products', 'as' => 'products.' ], function () {
				Route::get( '/', [ 'as' => 'index', 'uses' => 'ProductsController@index' ] );
				Route::get( 'create', [ 'as' => 'create', 'uses' => 'ProductsController@create' ] );
				Route::post( 'store', [ 'as' => 'store', 'uses' => 'ProductsController@store' ] );
				Route::get( 'edit/{id}', [ 'as' => 'edit', 'uses' => 'ProductsController@edit' ] );
				Route::put( 'update/{id}', [ 'as' => 'update', 'uses' => 'ProductsController@update' ] );
				Route::get( 'destroy/{id}', [ 'as' => 'destroy', 'uses' => 'ProductsController@destroy' ] );
		} );
		//Route of order
		Route::group( [ 'prefix' => 'orders', 'as' => 'orders.' ], function () {
				Route::get( '/', [ 'as' => 'index', 'uses' => 'OrdersController@index' ] );
				Route::get( '/edit/{id}', [ 'as' => 'edit', 'uses' => 'OrdersController@edit' ] );
				Route::put( '/update/{id}', [ 'as' => 'update', 'uses' => 'OrdersController@update' ] );
		} );
} );
