<?php

use App\Order;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function it_can_return_open_orders()
    {
        $openOrder1 = factory(Order::class)->create(['status' => Order::OPEN]);


        factory(Order::class)->create(['status' => Order::PENDING]);
        factory(Order::class)->create(['status' => Order::CLOSED]);

        $this->assertEquals($openOrder1->id, Order::open()->first()->id);
        $this->assertEquals(1, Order::open()->count());

        factory(Order::class)->create(['status' => Order::OPEN]);
        $this->assertEquals(2, Order::open()->count());
    }

}
