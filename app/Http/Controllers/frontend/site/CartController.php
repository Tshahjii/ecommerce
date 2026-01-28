<?php

namespace App\Http\Controllers\frontend\site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DiscountCoupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart($id)
    {
        if (!Auth::check()) {
            return redirect()->route('sign-in')->with('success', 'Login first!');
        }
        $user_id = decrypt($id);
        if ($user_id !== Auth::id()) {
            abort(403);
        }
        $cart = Cart::where('user_id', $user_id)->select('id', 'product_id', 'quantity')->get();
        $productIds = $cart->pluck('product_id');
        $products = Product::with(['firstProductImage', 'brand'])->whereIn('id', $productIds)->get();
        return view('frontend.site.cart', compact('cart', 'products'));
    }
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, 'redirect_url' => route('sign-in')]);
        }
        $cart = Cart::where('user_id', Auth::id())->where('product_id', $request->id)->first();
        if ($cart) {
            $cart->increment('quantity', $request->qty);
        } else {
            $cart = Cart::create(['user_id' => Auth::id(), 'product_id' => $request->id, 'quantity' => $request->qty]);
        }
        return response()->json(['status' => true, 'redirect_url' => route('product-cart', encrypt(Auth::id()))]);
    }
    public function deleteCartProduct($id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'You do not have access for this action!');
        }
        $cart = Cart::where('id', $id)->where('user_id', $user->id)->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Cart item not found!');
        }
        $cart->delete();
        return redirect()->back()->with('success', 'Cart items deleted successfully!');
    }
    public function updateCart(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        foreach ($request->cart as $item) {
            Cart::where('id', $item['cart_id'])->where('user_id', $user->id)->update(['quantity' => $item['quantity']]);
        }
        return response()->json(['status' => 'success']);
    }
    public function checkCode(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        $request->validate([
            'code' => 'required|string'
        ]);
        $discount = DiscountCoupon::where('code', $request->code)->first();
        if (!$discount) {
            return response()->json(['status' => 'error', 'message' => 'Code does not match!']);
        }
        if ($discount->expired_at && $discount->expired_at < now()) {
            return response()->json(['status' => 'error', 'message' => 'Code expired!']);
        }
        if ($discount->max_uses_user >= $discount->max_uses) {
            return response()->json(['status' => 'error', 'message' => 'Code limit exceeded!']);
        }
        $discount->increment('max_uses_user');
        return response()->json(['status' => 'success', 'message' => 'Coupon applied successfully!', 'discount' => $discount]);
    }
}
