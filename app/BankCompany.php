<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankCompany extends Model
{
    protected $table = 'bank_companies';
    protected $fillable = [
        'company_id', 'bank_id', 'account_no'
    ];
    public function company()
    {
        return $this->belongsTo(company_details::class, 'company_id');
    }
    public function bank()
    {
        return $this->belongsTo(bank::class, 'bank_id');
    }
}
