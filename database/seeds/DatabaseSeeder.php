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

        // $this->call(UserTableSeeder::class);

        $admin = factory(App\User::class, 'admin')->create();

        $this->attachOrdersAndProducts($admin);

        factory(App\User::class, 3)->create()->each(function($user) {
            $this->attachOrdersAndProducts($user);
        });

        Model::reguard();
    }

    protected function attachOrdersAndProducts($user){

        $faker = Faker\Factory::create();
        $units = ['Kg.', 'gr.', 'ud.', 'man.'];

        $user->orders()->saveMany(factory(App\Order::class, 5)->make());
        $user->products()->saveMany(factory(App\Product::class, 25)->make());

        foreach($user->orders as $key => $order){
            foreach ($user->products->pluck('id')->random(10)->values()->all() as $product_id) {
                $order->products()->attach($product_id, [
                    'price_amount' => $faker->numberBetween(1, 3000),
                    'price_unit' => $faker->randomElement($units),
                    'order_amount' => $faker->numberBetween(1, 100),
                    'order_unit' => $faker->randomElement($units),
                ]);
            }

        }

    }
}
