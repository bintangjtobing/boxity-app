<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class imagesItemGroup extends Model
{
    public $table = 'images_item_groups';
    public $fillable = [
        'itemGroupId', 'file'
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'itemGroupId');
    }
}
