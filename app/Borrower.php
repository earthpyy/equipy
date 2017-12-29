<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    protected $fillable = [
        'name', 'student_id', 'tel'
    ];

    public function lents() {
        return $this->hasMany('App\Lent');
    }
}
