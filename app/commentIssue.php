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
}
