<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemSales extends Model
{
    protected $table = 'item_sales';
    protected $fillable = [
        'item_code', 'qty', 'unit', 'price', 'remarks'
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'item_code');
    }
}
