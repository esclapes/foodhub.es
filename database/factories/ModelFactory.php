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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('test'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) use ($factory) {
    $user = $factory->raw(App\User::class);

    return array_merge($user, ['email' => 'admin@foodhub.es']);
});

$factory->define(App\Product::class, function(Faker\Generator $faker, $overrides = []){
    return [
        'name' => $faker->name,
        'user_id' => factory(App\User::class)->create()->id,
    ];
});


$factory->define(App\Order::class, function(Faker\Generator $faker){
    return [
        'name' => $faker->name,
        'description' => $faker->words(15, true),
        'closing_at' => $faker->dateTimeBetween('now', '+30 days'),
        'user_id' => factory(App\User::class)->create()->id,
    ];
});