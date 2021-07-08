<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesOrder extends Model
{
    protected $table = 'sales_orders';
    protected $fillable = [
        'so_number', 'customer', 'order_date', 'status', 'created_by',
        'updated_by', 'remarks'
    ];
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
