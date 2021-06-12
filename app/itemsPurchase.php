<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemsPurchase extends Model
{
    protected $table = 'items_purchases';
    protected $fillable = [
        'item_code', 'qty', 'unit', 'price', 'purpose', 'requested_by', 'used_by', 'remarks',
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'item_code');
    }
}
