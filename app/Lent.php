<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lent extends Model
{
    protected $fillable = [
        'qty', 'note', 'promising_date', 'return_date'
    ];

    protected $dates = [
        'promising_date', 'return_date'
    ];

    public function things() {
        return $this->belongsToMany('App\Thing')->withPivot('qty');
    }

    public function borrower() {
        return $this->belongsTo('App\Borrower');
    }

    public function approver() {
        return $this->belongsTo('App\User');
    }

    public function scopeOfBorrower($query, $borrower)
    {
        return $query->where('borrower_id', $borrower->id);
    }
}
