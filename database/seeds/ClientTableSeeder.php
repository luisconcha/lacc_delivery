<?php
use Illuminate\Database\Seeder;
use LaccDelivery\Models\Client;

class ClientTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{

				factory( Client::class, 6 )->create();
		}
}
