<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quotes extends Model
{
    protected $table = 'quotes';
    protected $fillable = [
        'quoteid',
        'quoteen',
        'createdId',
        'finishId',
        'status',
    ];
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'createdId');
    }
    public function finishBy()
    {
        return $this->belongsTo(User::class, 'finishId');
    }
}
