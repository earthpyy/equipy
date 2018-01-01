<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded = [];

    public function things() {
        return $this->hasMany('App\Thing');
    }
}
