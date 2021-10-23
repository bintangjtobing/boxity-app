<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class imagesStockGroup extends Model
{
    public $table = 'images_stock_groups';
    public $fillable = [
        'stockGroupId', 'file'
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'stockGroupId');
    }
}
