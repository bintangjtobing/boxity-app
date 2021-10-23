<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseReturn extends Model
{
    protected $table = 'purchase_returns';
    protected $fillable = [
        'pr_number', 'supplier', 'return_date', 'ref_no', 'status', 'created_by',
        'updated_by', 'remarks'
    ];
    public function suppliers()
    {
        return $this->belongsTo(User::class, 'supplier');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function item()
    {
        return $this->belongsTo(itemsPurchase::class, 'pr_number', 'purchasingId');
    }
}
