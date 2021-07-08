<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventoryItem extends Model
{
    protected $table = 'inventory_items';
    protected $fillable = [
        'item_code',
        'item_name',
        'qty',
        'unit',
        'type',
        'brand',
        'item_group',
        'width',
        'length',
        'thickness',
        'nt_weight',
        'gr_weight',
        'volume',
        'price',
        'customerId',
    ];
    public function itemGroup()
    {
        return $this->belongsTo(itemGroup::class, 'item_group');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customerId');
    }
}
