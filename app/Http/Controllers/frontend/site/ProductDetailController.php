<?php

namespace App\Http\Controllers\frontend\site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function productDetail($id)
    {
        $prod_id = decrypt($id);
        $product = Product::with(['firstProductImage', 'productImages', 'brand'])->findOrFail($prod_id);
        $related_product = collect();
        $relatedIds = collect(explode(',', (string) $product->related_product))->filter()->values();
        if ($relatedIds->isNotEmpty()) {
            $related_product = Product::with(['firstProductImage', 'brand'])->whereIn('id', $relatedIds)->where('id', '!=', $product->id)->get();
        }
        return view('frontend.site.product-details', compact('product', 'related_product'));
    }
    public function getProductDetails($id)
    {
        $product = Product::with(['firstProductImage', 'brand'])->findOrFail($id);
        return response()->json(['status' => 'success', 'data'   => $product]);
    }
}
