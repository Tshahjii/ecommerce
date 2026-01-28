<?php

namespace App\Http\Controllers\backend\site;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function discount()
    {
        $discount = DiscountCoupon::all();
        return view('backend.discount.index', compact('discount'));
    }
    public function getDiscount($id)
    {
        $discount = DiscountCoupon::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $discount]);
    }
    public function createDiscount(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:discount_coupons,code,' . $request->did,
            'name' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'type' => 'required|in:percent,fixed',
            'max_uses' => 'nullable',
            'starts_at' => 'required',
            'expired_at' => 'required',
            'status' => 'nullable',
        ]);
        if ($request->type === 'percent') {
            $discountData = $request->validate([
                'discount_amount' => 'required|numeric|min:1|max:100',
            ]);
        } else {
            $discountData = $request->validate([
                'discount_amount' => 'required|numeric|min:1|max:50000',
            ]);
        }
        $data = array_merge($data, $discountData);
        DiscountCoupon::updateOrCreate(['id' => $request->did], $data);
        return back()->with('success', $request->did ? 'Coupon updated successfully!' : 'Coupon created successfully!');
    }
    public function deleteDiscount($id)
    {
        $discount = DiscountCoupon::findOrFail($id);
        $discount->delete();
        return redirect()->back()->with('success', 'Discount deleted successfully!');
    }
}
