<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notepad extends Model
{
    protected $table = 'notepads';
    protected $fillable = [
        'userid',
        'title',
        'desc',
        'label',
        'favorite'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
