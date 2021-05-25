<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class warehouseList extends Model
{
    protected $table = 'warehouse_lists';
    protected $fillable = [
        'warehouse_code', 'warehouse_name',
        'address', 'remarks', 'pic', 'created_by'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'pic');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function customers()
    {
        return $this->belongsTo(warehouseCustomer::class, 'id', 'warehouse_id');
    }
}
