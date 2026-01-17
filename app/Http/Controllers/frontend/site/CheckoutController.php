<?php

namespace App\Http\Controllers\frontend\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('frontend.site.checkout');
    }
}
