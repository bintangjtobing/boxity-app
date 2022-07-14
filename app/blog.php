<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'description',
        'category',
        'views',
        'userid', 'status', 'slug'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
    public function image()
    {
        return $this->belongsTo(blogImages::class, 'id', 'blog_id');
    }
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
