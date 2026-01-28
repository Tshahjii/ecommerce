<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    public $fillable = ['code', 'name', 'description', 'type', 'discount_amount', 'max_uses', 'max_uses_user', 'status', 'starts_at', 'expired_at'];
}
