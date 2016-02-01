<?php

use App\Share;
use App\User;
use App\Order;
use App\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShareTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();

        $this->order = factory(Order::class)->create();

        $products = factory(Product::class, 10)->create();

        $this->order->addProducts($products);
    }

    /** @test */
    public function it_is_unique_for_the_same_email_and_order() {

        $this->setExpectedException('Illuminate\Database\QueryException');

        $share = new Share([
            'email' => $this->user->email,
            'phone' => '676676766',
            'comments' => 'Lorem ipsum comment'
        ]);

        $share->order_id = $this->order->id;

        $share->save();

        $share = new Share([
            'email' => $this->user->email,
            'phone' => '77474736',
            'comments' => 'Another Lorem ipsum comment'
        ]);

        $share->order_id = $this->order->id;

        $share->save();
    }

}
