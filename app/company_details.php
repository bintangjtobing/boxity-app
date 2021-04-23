<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company_details extends Model
{
    protected $table = 'company_details';
    protected $fillable = [
        'company_id',
        'company_name',
        'address',
        'city',
        'state',
        'country',
        'taxNumber',
        'phone',
        'email',
        'site',
    ];
}
