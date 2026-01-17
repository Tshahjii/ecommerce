<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['brands', 'slug', 'img_path', 'status'];
    public function brands_count()
    {
        return $this->hasMany(Product::class, 'brands');
    }
}
