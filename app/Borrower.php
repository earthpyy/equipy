<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Borrower extends Model
{
    use Searchable;

    protected $guarded = [];

    public function lents() {
        return $this->hasMany('App\Lent');
    }

    public function getTelAttribute($value) {
        return substr($value, 0, 3) . '-' . substr($value, 3);
    }

    public function getStudentIdAttribute($value) {
        return ($value == null ? '-' : $value[0] . '-' . substr($value, 1, 2) . '-' . substr($value, 3, 2) . '-' . substr($value, 5, 4) . '-' . substr($value, 9));
    }
}
