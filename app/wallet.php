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
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
    public function withdrawer()
    {
        return $this->belongsTo(withdraw::class, 'userid', 'requested_by');
    }
}
