<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class track_orders extends Model
{
    protected $table = 'track_orders';
    protected $fillable = [
        'order_id',
        'receiver',
        'sender',
        'receiver_city',
        'sender_city',
        'created_by',
        'updated_by',
        'order_status',
        'activity',
        'payload',
        'receiver_address',
        'sender_address',
        'stuff_desc'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function report()
    {
        return $this->belongsTo(track_reports::class, 'order_id');
    }
}
