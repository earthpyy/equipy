<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lent extends Model
{
    protected $fillable = [
        'note', 'promising_date'
    ];

    protected $dates = [
        'promising_date'
    ];

    public function things() {
        return $this->belongsToMany('App\Thing')->withPivot('status', 'return_date');
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
