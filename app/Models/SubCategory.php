<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['sub_category', 'slug', 'img_path', 'child_category_id', 'status'];
    public function child_category()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id', 'id');
    }
}
