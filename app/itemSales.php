<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemSales extends Model
{
    protected $table = 'item_sales';
    protected $fillable = [
        'item_code',
        'qtyOrdered',
        'qtyShipped',
        'unit',
        'price',
        'remarks',
        'so_status',
        'si_status',
        'sdeliveryreceipt_status',
        'sreturn_status',
        'salesId',
        'created_by',
        'updated_by',
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'item_code', 'item_code');
    }
    public function salesOrder()
    {
        return $this->belongsTo(salesOrder::class, 'salesId');
    }
    public function salesInvoices()
    {
        return $this->belongsTo(salesInvoice::class, 'salesId');
    }
    public function salesReturn()
    {
        return $this->belongsTo(salesReturn::class, 'salesId');
    }
    public function salesDeliveryReceipt()
    {
        return $this->belongsTo(salesDeliveryReceipt::class, 'salesId');
    }
}
