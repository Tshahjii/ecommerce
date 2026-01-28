<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Sidebar;
use Illuminate\Support\Facades\Route;

if (!function_exists('isHomeHeader')) {
    function isHomeHeader()
    {
        return Category::whereNull('parent_id')->with('children')->get();
    }
}
if (!function_exists('sidebar')) {
    function sidebar()
    {
        return Sidebar::with('children')->whereNull('parent_id')->where('status', 'active')->orderBy('tab_order', 'ASC')->get();
    }
}
if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route)
    {
        return Route::currentRouteName() === $route;
    }
}

if (!function_exists('isAnyChildActive')) {
    function isAnyChildActive($children)
    {
        foreach ($children as $child) {
            if (Route::currentRouteName() === $child->link_url) {
                return true;
            }
        }
        return false;
    }
}
if (!function_exists('sareesProduct')) {
    function sareesProduct()
    {
        return Product::with('firstProductImage')->where('sub_category', 36)->get();
    }
}
