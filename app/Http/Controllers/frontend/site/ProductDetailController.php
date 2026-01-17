<?php

namespace App\Http\Controllers\frontend\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function productDetail()
    {
        return view('frontend.site.product-details');
    }
}
