<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employeeSubDepartment extends Model
{
    protected $table = 'employee_sub_departments';
    protected $fillable = [
        'subdepartments_name', 'subdepartments_descriptions'
    ];
}
