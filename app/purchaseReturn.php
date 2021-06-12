<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseReturn extends Model
{
    protected $table = 'purchase_returns';
    protected $fillable = [
        'return_number', 'supplier', 'return_date', 'ref_no',
    ];
    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier');
    }
}
