<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseRequest extends Model
{
    protected $table = 'purchase_requests';
    protected $fillable = [
        'pre_number', 'priority', 'pr_date', 'to', 'status', 'created_by',
        'updated_by', 'remarks', 'approvedBy'
    ];
    public function warehouse()
    {
        return $this->belongsTo(warehouseList::class, 'to');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function item()
    {
        return $this->belongsTo(itemsPurchase::class, 'pre_number', 'purchasingId');
    }
    public function approved()
    {
        return $this->belongsTo(User::class, 'approvedBy');
    }
}
