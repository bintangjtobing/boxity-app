<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class imagesInventoryItem extends Model
{
    public $table = 'inventory-items-images';
    public $fillable = [
        'itemid', 'file'
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'itemid');
    }
}
