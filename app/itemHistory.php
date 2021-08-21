<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemHistory extends Model
{
    protected $table = 'inventory_item_histories';
    protected $fillable = [
        'itemId',
        'itemOutId',
        'itemInId',
        'type',
        'date',
        'qtyIn',
        'qtyOut'
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'itemId');
    }
    public function detailItemIn()
    {
        return $this->belongsTo(purchaseInvoice::class, 'itemInId', 'pi_number');
    }
    public function detailItemOut()
    {
        return $this->belongsTo(salesInvoice::class, 'itemOutId', 'si_number');
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
}
