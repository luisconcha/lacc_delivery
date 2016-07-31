<?php
use Illuminate\Database\Seeder;
use LaccDelivery\Models\OrderItem;

class OrderItemsTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				factory( OrderItem::class, 10 )->create();
		}
}
