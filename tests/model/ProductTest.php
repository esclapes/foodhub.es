<?php

use App\User;
use App\Order;
use App\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }


    /** @test */
    public function it_has_default_pricing_attributes()
    {

        $product = factory(Product::class)->create();

        $this->assertEquals(Product::pricingDefaults(), $product->pricing);

    }

    /** @test */
    public function it_can_get_pricing_values_on_creation()
    {
        $product = factory(Product::class)->create([], []);

        $this->assertEquals(Product::pricingDefaults(), $product->pricing);
    }


    /** @test */
    public function it_has_pricing_attributes_based_on_last_order()
    {

        $product = factory(Product::class)->create(['price_value' => 10]);

        $first = factory(Order::class)->create();
        $last = factory(Order::class)->create();

        $first->addProduct($product);
        $last->addProduct($product);

        $this->assertEquals(10, $last->products()->first()->pivot->price_value);

    }


}
