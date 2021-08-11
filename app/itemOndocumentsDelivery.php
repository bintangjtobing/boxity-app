<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemOndocumentsDelivery extends Model
{
    protected $table = 'item_documents_deliveries';
    protected $fillable = [
        'type',
        'receiptNumber',
        'destination',
        'remarks',
        'ddrId',
        'status',
        'created_by'
    ];
    public function documentDelivery()
    {
        return $this->belongsTo(documentsDelivery::class, 'ddrId', 'ddr_number');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
