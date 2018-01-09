<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    protected $guarded = [];

    public function type() {
        return $this->belongsTo('App\Type');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type_id', $type->id);
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
