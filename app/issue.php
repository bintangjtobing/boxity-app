<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class issue extends Model
{
    use Notifiable;

    const STATUS = [
        'PENDING' => 0,
        'OPEN' => 1,
        'CLOSED' => 2,
    ];
    const PRIORITY = [
        'LOW' => 0,
        'LOWEST' => 1,
        'MEDIUM' => 2,
        'HIGH' => 3,
        'HIGHEST' => 4,
    ];

    protected $table = 'issues';
    protected $fillable = [
        'title',
        'issue',
        'status',
        'created_by',
        'assignee',
        'priority',
        'approved_by',
    ];
    protected $casts = [
        'created_at' => 'datetime:l, d M, Y',
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function assigne()
    {
        return $this->belongsTo(User::class, 'assignee');
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function comments()
    {
        return $this->belongsTo(commentIssue::class, 'id', 'issueId');
    }
}
