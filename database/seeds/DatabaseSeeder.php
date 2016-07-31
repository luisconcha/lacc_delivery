<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				Model::unguard();
				$this->call( UserTableSeeder::class );
				$this->call( CategoryTableSeeder::class );
				$this->call( ClientTableSeeder::class );
				$this->call( OrderTableSeeder::class );
				$this->call( OrderItemsTableSeeder::class );
				Model::reguard();
		}
}