<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class goodsReceip extends Model
{
    protected $table = 'goods_receipts';
    protected $fillable = [
        'userid',
        'receiverid',
        'typeOfGoods',
        'courier',
        'receiptNumber',
        'description',
        'status'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiverid');
    }
}
