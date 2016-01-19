<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index() {

        $orders = Order::open();

        return view('welcome', compact('orders'));
    }
}
