<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesInvoice extends Model
{
    protected $table = 'sales_invoices';
    protected $fillable = [
        'si_number', 'customer', 'invoice_date', 'toGL', 'status', 'created_by', 'updated_by'
    ];
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer');
    }
}
