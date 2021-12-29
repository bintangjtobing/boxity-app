<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employeeSubDepartment extends Model
{
    protected $table = 'employee_sub_departments';
    protected $fillable = [
        'subdepartments_name', 'subdepartments_descriptions', 'departement_id'
    ];
    public function department()
    {
        return $this->belongsTo(employeeDepartment::class, 'departement_id');
    }
}
