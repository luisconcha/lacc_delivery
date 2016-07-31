<?php
/**
 * File: LaccDeliveryRepositoryProvider.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 24/07/16
 * Time: 22:39
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class LaccDeliveryRepositoryProvider extends ServiceProvider
{
		/**
		 * Bootstrap the application services.
		 *
		 * @return void
		 */
		public function boot()
		{

		}

		public function register()
		{
				$this->app->bind(
					\LaccDelivery\Repositories\CategoryRepository::class,
					\LaccDelivery\Repositories\CategoryRepositoryEloquent::class
				);
				$this->app->bind(
					\LaccDelivery\Repositories\ProductRepository::class,
					\LaccDelivery\Repositories\ProductRepositoryEloquent::class
				);
				$this->app->bind(
					\LaccDelivery\Repositories\ClientRepository::class,
					\LaccDelivery\Repositories\ClientRepositoryEloquent::class
				);
				$this->app->bind(
					\LaccDelivery\Repositories\UserRepository::class,
					\LaccDelivery\Repositories\UserRepositoryEloquent::class
				);
				$this->app->bind(
					\LaccDelivery\Repositories\OrderRepository::class,
					\LaccDelivery\Repositories\OrderRepositoryEloquent::class
				);
		}

}