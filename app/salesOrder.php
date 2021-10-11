<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesOrder extends Model
{
    protected $table = 'sales_orders';
    protected $fillable = [
        'so_number', 'customer', 'order_date', 'status', 'created_by',
        'updated_by', 'remarks', 'ecom_order_note', 'ecom_label_recipient', 'ecom_recipient_name', 'ecom_contact_num', 'ecom_city', 'ecom_zipcode', 'ecom_address', 'ecom_courier', 'ecom_bank_id',
    ];
    public function customers()
    {
        return $this->belongsTo(customers::class, 'customer');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
