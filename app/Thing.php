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

    public function scopeDefective($query)
    {
        return $query->where('status', 'DEFECTIVE');
    }
}
