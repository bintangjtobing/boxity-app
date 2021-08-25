<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseInvoice extends Model
{
    protected $table = 'purchase_invoices';
    protected $fillable = [
        'pi_number', 'supplier', 'invoice_date', 'reference_no', 'status', 'created_by',
        'updated_by', 'remarks', 'vehicle_no', 'drivers', 'deliver_to'
    ];
    public function warehouse()
    {
        return $this->belongsTo(warehouseList::class, 'deliver_to');
    }
    public function suppliers()
    {
        return $this->belongsTo(suppliers::class, 'supplier');
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function item()
    {
        return $this->belongsTo(itemsPurchase::class, 'pi_number', 'purchasingId');
    }
}
