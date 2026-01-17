<?php

namespace App\Http\Controllers\frontend\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('frontend.site.index');
    }
}
