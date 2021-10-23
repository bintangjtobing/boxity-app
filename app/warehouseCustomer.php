<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class warehouseCustomer extends Model
{
    protected $table = 'warehouse_customers';
    protected $fillable = [
        'warehouse_id', 'customer_id'
    ];
    public function warehouseDetail()
    {
        return $this->belongsTo(warehouseList::class, 'warehouse_id');
    }
    public function customerDetail()
    {
        return $this->belongsTo(customers::class, 'customer_id');
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
