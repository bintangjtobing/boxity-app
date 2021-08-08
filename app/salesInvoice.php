<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesInvoice extends Model
{
    protected $table = 'sales_invoices';
    protected $fillable = [
        'si_number', 'customer', 'invoice_date', 'toGL', 'status', 'created_by',
        'updated_by', 'remarks', 'reference_no', 'vehicle_no', 'drivers'
    ];
    public function customers()
    {
        return $this->belongsTo(User::class, 'customer');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
