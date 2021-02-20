<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLES = [
        'ADMIN' => 'admin',
        'USER' => 'user',
    ];

    const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0,
    ];
    const GENDER = [
        'MALE' => 'M',
        'FEMALE' => 'F',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status', 'createdBy', 'divisi', 'department', 'avatar', 'organisation', 'username', 'gender'
    ];

    protected $hidden = ['password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
