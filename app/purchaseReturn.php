<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseReturn extends Model
{
    protected $table = 'purchase_returns';
    protected $fillable = [
        'return_number', 'supplier', 'return_date', 'ref_no', 'status', 'created_by', 'updated_by'
    ];
    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
