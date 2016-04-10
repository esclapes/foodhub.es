<?php

use App\Group;
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
        $this->group = factory(Group::class)->create();
    }

    /** @test */
    public function it_belongs_to_no_group_by_default()
    {
        $this->assertEquals([], $this->user->groups->toArray());
    }

    /** @test */
    public function it_can_join_and_leave_groups()
    {
        $this->user->joinGroup($this->group);

        $this->assertEquals(TRUE, $this->group->hasUser($this->user));

        $this->user->leaveGroup($this->group);

        $this->assertEquals(FALSE, $this->group->hasUser($this->user));
    }

}
