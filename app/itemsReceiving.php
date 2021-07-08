<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemsReceiving extends Model
{
    protected $table = 'items_receivings';
    protected $fillable = [
        'item_code',
        'qtyOrdered',
        'qtyShipped',
        'unit',
        'remarks',
        'receiving_status',
        'receivingId',
        'created_by',
        'updated_by',
    ];
    public function item()
    {
        return $this->belongsTo(inventoryItem::class, 'item_code');
    }
    public function receivingNote()
    {
        return $this->belongsTo(receivingConfirmation::class, 'receivingId', 'receiving_number');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
