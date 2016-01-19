<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LandingTest extends TestCase
{
    /** @test */
    public function it_welcomes_you()
    {
        $this->visit('/')
             ->see(trans('landing.welcome'));
    }
}
