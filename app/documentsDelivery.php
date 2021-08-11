<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class documentsDelivery extends Model
{
    protected $table = 'documents_deliveries';
    protected $fillable = [
        'ddr_number', 'senderName', 'courier', 'status', 'created_by', 'updated_by'
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'senderName');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
