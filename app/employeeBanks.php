<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employeeBanks extends Model
{
    protected $table = 'employee_banks';
    protected $fillable = [
        'employee_id', 'bank_id', 'account_no'
    ];
    public function employee()
    {
        return $this->belongsTo(employee::class, 'employee_id');
    }
    public function bank()
    {
        return $this->belongsTo(bank::class, 'bank_id');
    }
}
