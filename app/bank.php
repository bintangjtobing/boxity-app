<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    protected $table = 'banks';
    protected $fillable = [
        'name', 'code'
    ];
}
