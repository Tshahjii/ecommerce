<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    protected $fillable = ['parent_id', 'tab_name', 'tab_icons', 'link_url', 'tab_order', 'status'];
    public function parent()
    {
        return $this->belongsTo(Sidebar::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Sidebar::class, 'parent_id')->where('status', 'active')->orderBy('tab_order', 'ASC');
    }
}
