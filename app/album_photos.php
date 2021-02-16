<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class album_photos extends Model
{
    protected $table = 'album_photos';
    protected $fillable = ['album_id', 'filename'];
}
