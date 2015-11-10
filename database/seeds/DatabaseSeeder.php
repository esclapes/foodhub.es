<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use League\Csv\Reader;

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

        $admin = factory(App\User::class, 'admin')->create();

        $this->attachOrdersAndProducts($admin);

        Model::reguard();
    }

    /**
     * Order, products and ordershares are related and attached to users
     * we use this function to populate the data. Only products are real
     * the rest are stubed with factories.
     *
     * @param $user
     */
    protected function attachOrdersAndProducts($user){

        $faker = Faker\Factory::create();

        $user->orders()->saveMany(factory(App\Order::class, 5)->make());

        // We create products from a real csv
        $reader = Reader::createFromPath(base_path('resources/import/products.csv'));
        $products = collect($reader->fetchAssoc());
        $products->transform(function($item, $key){
            return new App\Product($item);
        });
        $user->products()->saveMany($products);

        // Not all products are available in orders, here we randomly choose 10 products
        // and attach them to the user orders
        foreach($user->orders as $key => $order){
            foreach ($user->products->random(10)->values()->all() as $product) {
                $order->products()->attach($product->id, [
                    'price_value' => $product->price_value,
                    'price_amount' => $product->price_amount,
                    'price_unit' => $product->price_unit,
                    'step_amount' => $product->step_amount,
                    'step_unit' => $product->step_unit,
                ]);
            }
        }

    }
}
