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
        'userid',
        'warehouseid'
    ];
    public function itemGroup()
    {
        return $this->belongsTo(itemGroup::class, 'item_group');
    }
    public function stockGroup()
    {
        return $this->belongsTo(stockGroup::class, 'stock_group');
    }
    public function customer()
    {
        return $this->belongsTo(customers::class, 'customerId');
    }
    public function warehouse()
    {
        return $this->belongsTo(warehouseList::class, 'warehouseid');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
