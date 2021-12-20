<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class goodsReceip extends Model
{
    protected $table = 'goods_receipts';
    protected $fillable = [
        'userid',
        'type',
        'receiverid',
        'companies_receiver',
        'typeOfGoods',
        'courier',
        'receiptNumber',
        'description',
        'status'
    ];
    protected $casts = [
        'created_at' => 'datetime:d M, Y',
        'updated_at' => 'datetime:d M, Y',
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
