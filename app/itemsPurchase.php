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
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'item_code');
    }
    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
    public function usedBy()
    {
        return $this->belongsTo(User::class, 'used_by');
    }
    public function purchasingOrder()
    {
        return $this->belongsTo(purchaseOrder::class, 'purchasingId');
    }
    public function purchasingInvoices()
    {
        return $this->belongsTo(purchaseInvoice::class, 'purchasingId');
    }
    public function purchasingReturn()
    {
        return $this->belongsTo(purchaseReturn::class, 'purchasingId');
    }
    public function purchasingRequest()
    {
        return $this->belongsTo(purchaseRequest::class, 'purchasingId');
    }
}
