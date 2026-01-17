<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $fillable = ['child_category', 'slug', 'img_path', 'category_id', 'status'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function child_category()
    {
        return $this->hasMany(Product::class, 'child_category');
    }
    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class, 'child_category_id');
    }
}
