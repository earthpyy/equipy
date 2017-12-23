<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    protected $fillable = [
        'name', 'description', 'barcode', 'qty'
    ];

    public function type() {
        return $this->belongsTo('App\Type');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type_id', $type->id);
    }
}
