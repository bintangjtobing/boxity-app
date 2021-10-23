<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    protected $table = 'companies';
    protected $fillabel = [
        'company_name', 'customer_code', 'address', 'city', 'phone', 'email', 'npwp', 'site', 'bank_code', 'bank_account', 'bank_name'
    ];
}
