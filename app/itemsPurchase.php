<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemsPurchase extends Model
{
    protected $table = 'items_purchases';
    protected $fillable = [
        'item_code',
        'qtyOrdered',
        'qtyShipped',
        'qtyRequested',
        'qtyReturns',
        'unit',
        'price',
        'purpose',
        'requested_by',
        'used_by',
        'remarks',
        'po_status',
        'pi_status',
        'prequest_status',
        'preturn_status',
        'purchasingId',
        'created_by',
        'updated_by',
        'supplierId',
        'warehouseId',
        'customerId',
        'driver_name',
        'driver_nopol',
        'weightIn', 'weightOut'
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'item_code');
    }
    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
    public function supplier()
    {
        return $this->belongsTo(suppliers::class, 'supplierId');
    }
    public function warehouse()
    {
        return $this->belongsTo(warehouseList::class, 'warehouseId');
    }
    public function customer()
    {
        return $this->belongsTo(customers::class, 'customerId');
    }
    public function used()
    {
        return $this->belongsTo(User::class, 'used_by');
    }
    public function usedBy()
    {
        return $this->belongsTo(User::class, 'used_by');
    }
    public function purchasingOrder()
    {
        return $this->belongsTo(purchaseOrder::class, 'purchasingId', 'po_number');
    }
    public function purchasingInvoices()
    {
        return $this->belongsTo(purchaseInvoice::class, 'purchasingId', 'pi_number');
    }
    public function purchasingReturn()
    {
        return $this->belongsTo(purchaseReturn::class, 'purchasingId', 'pr_number');
    }
    public function purchasingRequest()
    {
        return $this->belongsTo(purchaseRequest::class, 'purchasingId', 'pre_number');
    }
}
