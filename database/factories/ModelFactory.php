<?php

use App\User;
use App\Order;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Order::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(),
        'status' => $faker->randomElement([Order::OPEN, Order::CLOSED, Order::CREATED, Order::ARCHIVED, Order::PENDING]),
    ];
});
