<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('front.dashboard');
    }

    public function testPage(){
        return "Paypal";
    }
}
