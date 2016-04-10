<?php

use App\Group;
use App\User;
use App\Order;
use App\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->group = factory(Group::class)->create();
    }

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

    /** @test */
    public function it_belongs_to_a_team()
    {
        $order = factory(Order::class)->create(['group_id' => $this->group->id]);

        $this->assertEquals($this->group->id, $order->group->id);
    }

    /** @test */
    public function it_can_have_a_product_added()
    {

        $product = factory(Product::class)->create();

        $order = factory(Order::class)->create();

        $order->addProduct($product);

        $this->assertEquals($product->id, $order->products()->first()->id);
        $this->assertEquals($product->created_at, $order->products()->first()->created_at);
    }

    /** @test */
    public function it_can_have_many_products_added()
    {

        $products = factory(Product::class, 5)->create();

        $order = factory(Order::class)->create();

        $order->addProducts($products);

        $this->assertEquals($products->count(), $order->products()->count());

    }


}
