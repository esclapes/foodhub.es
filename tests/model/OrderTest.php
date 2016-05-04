<?php

use App\Group;
use App\ShareItem;
use App\User;
use App\Order;
use App\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->group = factory(Group::class)->create();
        $this->openOrder = factory(Order::class)->create(['status' => Order::OPEN]);
    }

    /** @test */
    public function it_can_return_open_orders()
    {


        factory(Order::class)->create(['status' => Order::PENDING]);
        factory(Order::class)->create(['status' => Order::CLOSED]);

        $this->assertEquals($this->openOrder->id, Order::open()->first()->id);
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

    /** @test */
    public function it_throws_if_a_share_item_do_not_match_to_order_products() {

        $this->setExpectedException(ModelNotFoundException::class);

        $product_amount = ['15' => '5'];
        $this->openOrder->getShareItems($product_amount);
    }

    /** @test */
    public function it_builds_share_items_based_on_form_input() {

        $products = factory(Product::class, 5)->make(['group_id' => $this->group->id]);
        $this->openOrder->products()->saveMany($products);


        $product = $this->openOrder->products->first();
        $amount = 10;

        $input[$product->id] = $amount;

        $share_items = $this->openOrder->getShareItems($input);

        $item = $share_items->first();

        $this->assertInstanceOf(ShareItem::class, $item);

        $this->assertEquals($amount, $item->amount);

        $this->assertEquals($item, $this->openOrder->getShareItem($product->id, $amount));

    }

}
