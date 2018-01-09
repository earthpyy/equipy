<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrowing extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = [
        'promising_date', 'completed_date', 'deleted_at'
    ];

    public function equipment() {
        return $this->belongsToMany('App\Equipment')->withPivot('status', 'return_date');
    }

    public function borrower() {
        return $this->belongsTo('App\Borrower');
    }

    public function approver() {
        return $this->belongsTo('App\User');
    }

    public function getPromisingDateAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    public function scopeOfBorrower($query, $borrower)
    {
        return $query->where('borrower_id', $borrower->id);
    }
}
