<?php

use App\Group;
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

$factory->define(Order::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'status' => $faker->randomElement([Order::OPEN, Order::CLOSED, Order::CREATED, Order::ARCHIVED, Order::PENDING]),
        'closing_at' => $faker->dateTimeBetween('-5 days', '+5 days'),
        'group_id' => factory(Group::class)->create()->id,
    ];
});

$factory->define(Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(2, true),
        'group_id' => factory(Group::class)->create()->id,
    ];
});

$factory->define(Group::class, function (Faker\Generator $faker) {
    $name = $faker->word(2, true);
    return [
      'name' => $name,
      'slug' => \Slugify::slugify($name),
      'owner_id' => factory(User::class)->create()->id,
    ];
});
