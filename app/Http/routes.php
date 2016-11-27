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
/**
 * Bloco Cors
 */
Route::group( [ 'middleware' => 'cors' ], function () {
		Route::post( 'oauth/access_token', function () {
				return Response::json( Authorizer::issueAccessToken() );
		} );
		/**
		 * Agrupamento das rotas da API protegidas pelo OAuth2
		 */
		Route::group( [ 'prefix' => 'api', 'as' => 'api.', 'middleware' => 'oauth' ], function () {
				//Rota que retorna os dados da pessoa authenticada
				Route::get( 'authenticated', [ 'as' => 'authenticated', 'uses' => 'Api\UserController@authenticated' ] );
				//
				Route::group( [ 'prefix' => 'client', 'as' => 'client.', 'middleware' => 'oauth.checkrole:client' ], function () {
						//Rota restfull client
						Route::resource( 'order',
							'Api\Client\ClientCheckoutController',
							[ 'except' => [ 'create', 'edit', 'destroy' ] ]
						);
						Route::get( 'products', [ 'as' => 'products', 'uses' => 'Api\Client\ClientProductController@index' ] );
				} );
				//
				Route::group( [ 'prefix' => 'deliveryman', 'as' => 'deliveryman.', 'middleware' => 'oauth.checkrole:deliveryman' ], function () {
						//Rota restfull deliveryman
						Route::resource( 'order',
							'Api\Deliveryman\DeliverymanCheckoutController',
							[ 'except' => [ 'create', 'edit', 'destroy' ] ]
						);
						//Atualzia dado de um recurso
						Route::patch( 'order/{id}/update-status', [ 'as' => 'orders.update_status', 'uses' => 'Api\Deliveryman\DeliverymanCheckoutController@updateStatus' ] );
				} );
				//
				Route::get( 'cupom/{cupomCode}', 'Api\CupomController@show' );

		} );
} );
/**
 * Grupo ADMIN
 */
Route::group( [ 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth.checkrole:admin' ], function () {
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
		// Route of cupoms
		Route::group( [ 'prefix' => 'cupoms', 'as' => 'cupoms.' ], function () {
				Route::get( '/', [ 'as' => 'index', 'uses' => 'CupomsController@index' ] );
				Route::get( 'create', [ 'as' => 'create', 'uses' => 'CupomsController@create' ] );
				Route::post( 'store', [ 'as' => 'store', 'uses' => 'CupomsController@store' ] );
				Route::get( 'edit/{id}', [ 'as' => 'edit', 'uses' => 'CupomsController@edit' ] );
				Route::put( 'update/{id}', [ 'as' => 'update', 'uses' => 'CupomsController@update' ] );
				Route::get( 'destroy/{id}', [ 'as' => 'destroy', 'uses' => 'CupomsController@destroy' ] );
		} );
		//Route of order
		Route::group( [ 'prefix' => 'orders', 'as' => 'orders.' ], function () {
				Route::get( '/', [ 'as' => 'index', 'uses' => 'OrdersController@index' ] );
				Route::get( '/edit/{id}', [ 'as' => 'edit', 'uses' => 'OrdersController@edit' ] );
				Route::put( '/update/{id}', [ 'as' => 'update', 'uses' => 'OrdersController@update' ] );
		} );
} );
//Route of customer
Route::group( [ 'prefix' => 'customer', 'middleware' => 'auth.checkrole:client', 'as' => 'customer.' ], function () {
		Route::get( '/order', [ 'as' => 'order.index', 'uses' => 'CheckoutController@index' ] );
		Route::get( '/order/create', [ 'as' => 'order.create', 'uses' => 'CheckoutController@create' ] );
		Route::post( '/order/store', [ 'as' => 'order.store', 'uses' => 'CheckoutController@store' ] );
//		Route::get( '/edit/{id}', [ 'as' => 'edit', 'uses' => 'CheckoutController@edit' ] );
//		Route::put( '/update/{id}', [ 'as' => 'update', 'uses' => 'CheckoutControllers@update' ] );
} );