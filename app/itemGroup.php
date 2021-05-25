<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemGroup extends Model
{
    protected $table = 'item_groups';
    protected $fillable = [
        'itemgroup_id',
        'stock_id',
        'name',
        'remarks',
        'created_by'
    ];
    public function stock()
    {
        return $this->belongsTo(stockGroup::class, 'stock_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
