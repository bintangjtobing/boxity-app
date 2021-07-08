<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receivingConfirmation extends Model
{
    protected $table = 'receiving_confirmations';
    protected $fillable = [
        'receiving_number',
        'customer',
        'receiving_date',
        'receiving_warehouse',
        'drivers',
        'vehicle_no',
        'status',
        'remarks',
        'created_by',
        'updated_by',
    ];
    public function customers()
    {
        return $this->belongsTo(User::class, 'customer');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function warehouse()
    {
        return $this->belongsTo(warehouseList::class, 'receiving_warehouse');
    }
}
