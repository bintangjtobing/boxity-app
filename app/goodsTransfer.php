<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class goodsTransfer extends Model
{
    protected $table = 'goods_transfers';
    protected $fillable = [
        'refNumber',
        'mutation_date',
        'from',
        'to,'
    ];
    public function fromWarehouse()
    {
        return $this->belongsTo(warehouseList::class, 'from');
    }
    public function toWarehouse()
    {
        return $this->belongsTo(warehouseList::class, 'to');
    }
}
