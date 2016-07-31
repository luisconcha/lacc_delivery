<?php
use Illuminate\Database\Seeder;
use LaccDelivery\Models\Order;

class OrderTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{

				factory( Order::class, 10 )->create();
		}
}
