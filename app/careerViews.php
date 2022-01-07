<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class careerViews extends Model
{
    protected $table = 'jobvacancies_views';
    protected $fillable = [
        'job_id', 'views', 'ip_address'
    ];
    public function career()
    {
        return $this->belongsTo(jobvacancy::class, 'job_id');
    }
}
