<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseRequest extends Model
{
    protected $table = 'purchase_requests';
    protected $fillable = [
        'pr_no', 'priority', 'pr_date', 'to', 'status', 'created_by',
        'updated_by', 'remarks'
    ];
    public function to()
    {
        return $this->belongsTo(User::class, 'to');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
