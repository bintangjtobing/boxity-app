<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseRequest extends Model
{
    protected $table = 'purchase_requests';
    protected $fillable = [
        'pr_no', 'priority', 'pr_date', 'to'
    ];
    public function to()
    {
        return $this->belongsTo(User::class, 'to');
    }
}
