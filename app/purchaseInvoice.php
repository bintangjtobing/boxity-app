<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseInvoice extends Model
{
    protected $table = 'purchase_invoices';
    protected $fillable = [
        'purchase_invoices', 'supplier', 'invoice_date', 'reference_no', 'status', 'created_by', 'updated_by'
    ];
    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'supplier');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
