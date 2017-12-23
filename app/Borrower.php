<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    protected $fillable = [
        'name', 'tel'
    ];

    public function lents() {
        return $this->hasMany('App\Lent');
    }
}
