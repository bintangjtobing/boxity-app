<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class changeLog extends Model
{
    protected $table = 'change_logs';
    protected $fillable = [
        'version', 'description'
    ];
    protected $casts = [
        'created_at' => 'datetime:d M, Y',
    ];
}
