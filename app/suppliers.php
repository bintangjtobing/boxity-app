<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
{
    protected $table = 'suppliers';
    protected $fillabel = [
        'supplier_name', 'supplier_code', 'address', 'city', 'phone', 'email', 'npwp', 'site', 'bank_code', 'bank_account', 'bank_name'
    ];
}
