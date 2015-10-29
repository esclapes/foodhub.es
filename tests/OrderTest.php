<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_requires_a_closing_date()
    {
        $this->withoutMiddleware();

        $response = $this->call('POST', 'orders', [
            'name' => 'Test order',
            'description' => 'Test description',
        ]);

        $this->assertEquals(301, $response->status());
    }
}
