<?php

use App\Order;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use League\Csv\Reader;

class NewOrderTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        Model::unguard();

        $this->user = factory(User::class)->create();

        $this->order = factory(Order::class)->create(['status' => Order::OPEN, 'user_id' => $this->user->id]);

        // We create products from a real csv
        $reader = Reader::createFromPath(base_path('resources/import/products.csv'));
        $products = collect(iterator_to_array($reader->fetchAssoc()));
        $products->transform(function($item, $key){
            return new Product($item);
        });
        $this->user->products()->saveMany($products);
        // Not all products are available in orders, here we randomly choose 10 products
        // and attach them to the user orders

        foreach ($products->random(10)->values()->all() as $product) {
            $this->order->addProduct($product);
        }

        Model::reguard();
    }

    /** @test */
    public function it_shows_available_products_and_description()
    {

        $this->visit('/o/' . $this->order->getRouteKey())
            ->see($this->order->title)
            ->see($this->order->description)
            ->see($this->order->products->first()->name);
    }


    public function it_fshows_a_open_orders_with_a_link()
    {
        $newOrders = factory(Order::class, 4)->create(['status' => Order::OPEN]);

        $this->visit('/')
            ->seeLink($newOrders[0]->title, action('ShareController@create', $newOrders[0]->id))
            ->seeLink($newOrders[1]->title, action('ShareController@create', $newOrders[1]->id))
            ->seeLink($newOrders[2]->title, action('ShareController@create', $newOrders[2]->id))
            ->seeLink($newOrders[3]->title, action('ShareController@create', $newOrders[3]->id));
    }


    public function it_shows_a_dashboard_link_monly_to_managers()
    {
        $user = factory(User::class)->create();

        $this->be($user);

        $this->visit('/')
            ->dontSeeLink(trans('dashboard.name'));

        $user->makeManager();

        $this->visit('/')
            ->seeLink(trans('dashboard.name'), action('DashboardController@index'));

    }

}
