<?php

use App\Order;
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
}
