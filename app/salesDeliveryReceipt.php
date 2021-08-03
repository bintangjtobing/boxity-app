<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesDeliveryReceipt extends Model
{
    protected $table = 'sales_delivery_receipts';
    protected $fillable = [
        'sdr_number',
        'customer',
        'sdr_date',
        'reference_no',
        'drivers',
        'vehicle_no',
        'deliver_to',
        'status',
        'created_by',
        'updated_by',
        'remarks'
    ];
    public function customers()
    {
        return $this->belongsTo(User::class, 'customer');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function warehouse()
    {
        return $this->belongsTo(warehouseList::class, 'deliver_to');
    }
}
