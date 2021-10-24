<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employeeDepartment extends Model
{
    protected $table = 'employee_departments';
    protected $fillable = [
        'departments_name', 'departments_descriptions'
    ];
}
