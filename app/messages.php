<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'from', 'to', 'text'
    ];
    protected $casts = [
        'created_at' => 'datetime:d M, Y',
        'updated_at' => 'datetime:H:i A'
    ];
    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
}
