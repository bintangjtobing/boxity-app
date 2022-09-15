<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class withdrawLog extends Model
{
    protected $table = 'withdraw_logs';
    protected $fillable = ['remarks', 'requested_by'];
    protected $casts = [
        'updated_at' => 'datetime:M d, Y',
    ];
    public function wd()
    {
        return $this->belongsTo(withdraw::class, 'withdraw_id');
    }
    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
