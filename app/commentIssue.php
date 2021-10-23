<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commentIssue extends Model
{
    protected $table = 'comment_issues';
    protected $fillable = [
        'fromId',
        'issueId',
        'comment',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'fromId');
    }
    public function issue()
    {
        return $this->belongsTo(issue::class, 'issueId');
    }
}
