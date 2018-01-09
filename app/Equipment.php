<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $guarded = [];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function scopeOfCategory($query, $category)
    {
        return $query->where('category_id', $category->id);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'AVAILABLE');
    }

    public function scopeDefective($query)
    {
        return $query->where('status', 'DEFECTIVE');
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('status', 'OUTOFSTOCK');
    }
}
