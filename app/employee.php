<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'employee_code',
        'employee_name',
        'employee_nickname',
        'employee_sex',
        'employee_age',
        'employee_pic',
        'employee_working_duration',
        'birth_place', 'birth_date',
        'date_join',
        'nationality',
        'identity_no',
        'religion',
        'event',
        'weight',
        'height',
        'blood_type',
        'tax_id',
        'bpjstk',
        'bpjskes',
        'email', 'phone',
        'job_title',
        'job_type',
        'departments',
        'sub_departments'
    ];
    public function department()
    {
        return $this->belongsTo(employeeDepartment::class, 'departments');
    }
    public function subdepartment()
    {
        return $this->belongsTo(employeeSubDepartment::class, 'sub_departments');
    }
    protected $casts = [
        'created_at' => 'datetime:d M, Y',
    ];
}
