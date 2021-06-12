<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseOrder extends Model
{
    protected $table = 'purchase_orders';
    protected $fillable = [
        'po_number', 'supplier', 'order_date', 'deliver_to', 'status', 'created_by', 'updated_by'
    ];
    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'supplier');
    }
    public function recipient()
    {
        return $this->belongsTo(warehouseList::class, 'deliver_to');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
