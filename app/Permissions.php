<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Permissions extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'name', 'slug'
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }
}
