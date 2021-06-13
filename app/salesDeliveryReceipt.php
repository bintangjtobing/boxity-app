<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesDeliveryReceipt extends Model
{
    protected $table = 'sales_delivery_receipts';
    protected $fillable = [
        'sdr_number', 'customer', 'sdr_date', 'toGL', 'status', 'created_by', 'updated_by'
    ];
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer');
    }
}
