<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class albums extends Model
{
    protected $table = 'albums';
    protected $fillable = ['nama_album'];
}
