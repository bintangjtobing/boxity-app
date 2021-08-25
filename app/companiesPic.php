<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class companiesPic extends Model
{
    protected $table = 'companies_pic';
    protected $fillable = [
        'company_id', 'user_id'
    ];
    public function companyDetail()
    {
        return $this->belongsTo(customers::class, 'company_id');
    }
    public function userDetail()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
