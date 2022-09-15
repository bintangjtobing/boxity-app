<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class withdraw extends Model
{
    protected $table = 'withdraws';
    protected $fillable = [
        'price', 'bank_id', 'requested_by', 'approved_by', 'account_no', 'account_number', 'status', 'remarks'
    ];
    protected $casts = [
        'created_at' => 'datetime:M d, Y',
        'updated_at' => 'datetime:M d, Y',
    ];
    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function banks()
    {
        return $this->belongsTo(bank::class, 'bank_id');
    }
}
