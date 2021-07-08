<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesReturn extends Model
{
    protected $table = 'sales_returns';
    protected $fillable = [
        'return_number', 'customer', 'return_date', 'toGL', 'status', 'created_by',
        'updated_by', 'remarks'
    ];
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
