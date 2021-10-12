<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inboxMessage extends Model
{
    protected $table = 'inbox_messages';
    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message', 'status'
    ];
    protected $casts = [
        'created_at' => 'datetime:l, d M, Y',
    ];
}
