<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesInvoice extends Model
{
    protected $table = 'sales_invoices';
    protected $fillable = [
        'si_number', 'customer', 'invoice_date', 'toGL', 'status', 'created_by',
        'updated_by', 'remarks', 'reference_no', 'vehicle_no', 'drivers', 'ecom_order_note', 'ecom_label_recipient', 'ecom_recipient_name', 'ecom_contact_num', 'ecom_city', 'ecom_zipcode', 'ecom_address', 'ecom_courier', 'ecom_bank_id',
    ];
    public function items()
    {
        return $this->hasMany('App\ItemsSales', 'salesingId', 'si_number');
    }
    public function customers()
    {
        return $this->belongsTo(customers::class, 'customer');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
