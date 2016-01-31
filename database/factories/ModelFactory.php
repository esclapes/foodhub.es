<?php

use App\User;
use App\Order;
use App\Product;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->defineAs(User::class, 'manager', function (Faker\Generator $faker) use ($factory) {
    $user = $factory->raw(App\User::class);

    $user['is_manager'] = TRUE;

    return $user;
});

$factory->define(Order::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(),
        'status' => $faker->randomElement([Order::OPEN, Order::CLOSED, Order::CREATED, Order::ARCHIVED, Order::PENDING]),
        'user_id' => factory(User::class)->create()->id,
    ];
});

$factory->define(Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(2, true),
        'user_id' => factory(User::class)->create()->id,
    ];
});
