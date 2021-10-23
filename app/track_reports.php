<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class track_reports extends Model
{
    protected $table = 'track_reports';
    protected $fillable = [
        'track_id',
        'order_id',
        'current_location',
        'last_location',
        'status',
        'container_type_system',
        'estimated_arrival_date',
        'updated_by',
        'activity',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    public function orders()
    {
        return $this->belongsTo(track_orders::class, 'order_id', 'order_id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
