<?php
use Illuminate\Database\Seeder;
use LaccDelivery\Models\User;
use LaccDelivery\Models\Client;

class UserTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				factory( 'LaccDelivery\Models\User' )->create(
					[
						'name'           => 'Entregador 01',
						'email'          => 'entragador01@gmail.com',
						'password'       => bcrypt( '123456' ),
						'role'           => 'deliveryman',
						'remember_token' => str_random( 10 ),
					]
				);
				factory( 'LaccDelivery\Models\User' )->create(
					[
						'name'           => 'Entregador 02',
						'email'          => 'entragador02@gmail.com',
						'password'       => bcrypt( '123456' ),
						'role'           => 'deliveryman',
						'remember_token' => str_random( 10 ),
					]
				);
				factory( 'LaccDelivery\Models\User' )->create(
					[
						'name'           => 'Luis Alberto Concha Curay',
						'email'          => 'luvett11@gmail.com',
						'password'       => bcrypt( '123456' ),
						'role'           => 'admin',
						'remember_token' => str_random( 10 ),
					]
				);
				factory( User::class, 5 )->create();
		}
}
