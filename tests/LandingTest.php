<?php

use App\Order;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LandingTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function it_welcomes_you()
    {
        $this->visit('/')
             ->see(trans('landing.welcome'));
    }

    /** @test */
    public function it_shows_a_list_of_current_open_orders()
    {
        $newOrders = factory(Order::class, 4)->create(['status' => Order::OPEN]);

        $this->visit('/')
            ->see($newOrders[0]->title)
            ->see($newOrders[1]->title)
            ->see($newOrders[2]->title)
            ->see($newOrders[3]->title);
    }

    /** @test */
    public function it_shows_a_open_orders_with_a_link()
    {
        $newOrders = factory(Order::class, 4)->create(['status' => Order::OPEN]);

        $this->visit('/')
            ->seeLink($newOrders[0]->title)
            ->seeLink($newOrders[1]->title)
            ->seeLink($newOrders[2]->title)
            ->seeLink($newOrders[3]->title);
    }

    /** @test */
    public function it_shows_a_dashboard_link_only_to_managers()
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
