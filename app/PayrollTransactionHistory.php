<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollTransactionHistory extends Model
{
    protected $table = 'payroll_transaction_histories';
    protected $fillable = [
        'transaction_name', 'status', 'batch_file'
    ];
}
