<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define( LaccDelivery\Models\User::class, function ( Faker\Generator $faker ) {
		return [
			'name'           => $faker->name,
			'email'          => $faker->safeEmail,
			'password'       => bcrypt( str_random( 10 ) ),
			'remember_token' => str_random( 10 ),
		];
} );
$factory->define( LaccDelivery\Models\Category::class, function ( Faker\Generator $faker ) {
		return [
			'name' => $faker->word,
		];
} );
$factory->define( LaccDelivery\Models\Product::class, function ( Faker\Generator $faker ) {
		return [
			'name'        => $faker->word,
			'description' => $faker->sentence(),
			'price'       => $faker->numberBetween( 10, 50 ),
		];
} );
$factory->define( LaccDelivery\Models\Client::class, function ( Faker\Generator $faker ) {
		return [
			'user_id' => $faker->numberBetween( 1, 6 ),
			'phone'   => $faker->phoneNumber,
			'address' => $faker->address,
			'city'    => $faker->city,
			'state'   => $faker->state,
			'zipcode' => $faker->postcode,
		];
} );
$factory->define( LaccDelivery\Models\Order::class, function ( Faker\Generator $faker ) {
		return [
			'client_id'           => $faker->numberBetween( 2, 5 ),
			'user_deliveryman_id' => rand( 1, 2 ),
			'total'               => $faker->randomNumber( 2 ),
			'status'              => rand( 0, 3 ),
		];
} );
$factory->define( LaccDelivery\Models\OrderItem::class, function ( Faker\Generator $faker ) {
		return [
			'product_id' => $faker->numberBetween( 1, 60 ),
			'order_id'   => $faker->unique()->numberBetween( 1, 10 ),
			'price'      => $faker->randomNumber( 3 ),
			'qtd'        => $faker->randomNumber( 1 ),
		];
} );
$factory->define( LaccDelivery\Models\Cupom::class, function ( Faker\Generator $faker ) {
		return [
			'code'  => rand( 100, 900 ),
			'value' => rand( 50, 100 ),
		];
} );
$factory->define( LaccDelivery\Models\OAuthClients::class, function ( Faker\Generator $faker ) {
		return [];
} );
