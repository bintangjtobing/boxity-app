<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class goodsItemTransfer extends Model
{
    protected $table = 'goods_item_transfers';
    protected $fillable = [
        'itemCode',
        'qty',
        'unit',
        'remarks',
        'tf_goods_id'
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'itemCode');
    }
    public function goodsTfID()
    {
        return $this->belongsTo(goodsTransfer::class, 'tf_goods_id');
    }
}
