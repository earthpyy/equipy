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
}
