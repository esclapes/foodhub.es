<?php

use App\Product;
use App\Share;
use App\User;
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

        $user = factory(App\User::class)->create();

        $group = factory(App\Group::class)->create(['owner_id' => $user->id]);

        $this->attachOrdersAndProducts($group);

        $this->generateOrderSharesFor($group);

        Model::reguard();
    }

    /**
     * Order, products and ordershares are related and attached to users
     * we use this function to populate the data. Only products are real
     * the rest are stubed with factories.
     *
     * @param $group
     */
    protected function attachOrdersAndProducts($group){

        $faker = Faker\Factory::create();

        $group->orders()->saveMany(factory(App\Order::class, 5)->make(['group_id' => $group->id]));
        $order=factory(App\Order::class)->make(['status' => App\Order::OPEN, 'group_id' => $group->id]);
        $group->orders()->save($order);

        // We create products from a real csv
        $reader = Reader::createFromPath(base_path('resources/import/products.csv'));
        $products = collect(iterator_to_array($reader->fetchAssoc()));
        $products->transform(function($item, $key){
            return new Product($item);
        });

        $group->addProducts($products);

        // Not all products are available in orders, here we randomly choose 10 products
        // and attach them to the user orders
        foreach($group->orders as $key => $order){
            foreach ($group->products->random(10)->values()->all() as $product) {
                $order->addProduct($product);
            }
        }

    }

    private function generateOrderSharesFor($group)
    {
        $users = User::all();
        foreach($group->orders as $order) {
            foreach($users->random(6)->values()->all() as $user ) {
                $share = new Share(['email' => $user->email, 'order_id' => $order->id]);
                $share->save();
                $items = [];
                $order->products->random(5)->each(function($item){
                    $items[$item->id] = rand(1, 7) * $item->pivot->step_amount;
                }, array());
                $items = $order->getShareItems($items);
                $share->items()->saveMany($items);
            }
        }
    }
}
