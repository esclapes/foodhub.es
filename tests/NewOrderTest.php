<?php

use App\Order;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewOrderTest extends TestCase
{

    use DatabaseMigrations;


    /** @test */
    public function it_shows_available_products()
    {
        $order = factory(Order::class)->create(['status' => Order::OPEN]);

        $this->visit('/o/' . $order->getRouteKey())
            ->see($order->title);
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
