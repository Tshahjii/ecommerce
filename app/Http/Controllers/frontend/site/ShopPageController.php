<?php

namespace App\Http\Controllers\frontend\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{
    public function shopPage()
    {
        return view('frontend.site.shop-page');
    }
    public function shopFullPage()
    {
        return view('frontend.site.shop-full-page');
    }
}
