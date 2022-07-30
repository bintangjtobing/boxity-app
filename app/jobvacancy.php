<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jobvacancy extends Model
{
    protected $table = 'jobvacancies';
    protected $fillable = [
        'title',
        'location',
        'divisi',
        'part',
        'description', 'slug'
    ];
    protected $casts = [
        'created_at' => 'datetime:d M, Y',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->slug = Str::slug($model->title, '-');
        });
    }
}
