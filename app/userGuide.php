<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userGuide extends Model
{
    protected $table = 'user_guides';
    protected $fillable = [
        'title',
        'description',
    ];
}
