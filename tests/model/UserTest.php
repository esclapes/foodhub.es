<?php

use App\User;
use App\Order;
use App\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_is_not_a_manager_by_default()
    {
        $this->assertEquals(FALSE, $this->user->isManager());
    }

    /** @test */
    public function it_can_be_made_manager()
    {
        $this->user->makeManager();

        $this->assertEquals(TRUE, $this->user->isManager());
    }


}
