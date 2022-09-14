<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wallet extends Model
{
    protected $table = 'wallets';
    protected $fillable = [
        'userid', 'amount', 'currency', 'type'
    ];
    protected $casts = [
        'updated_at' => 'datetime:d M, Y h:m:s',
    ];
    public function approver()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
