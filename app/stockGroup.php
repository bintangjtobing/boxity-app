<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stockGroup extends Model
{
    protected $table = 'stock_groups';
    protected $fillable = [
        'stockgroup_id',
        'customer_id',
        'name',
        'remarks',
        'created_by'
    ];
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
