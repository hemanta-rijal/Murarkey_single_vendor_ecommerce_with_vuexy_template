<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $fillable = ['name', 'slug', 'routes'];

    public function roles()
    {

        return $this->belongsToMany(Role::class, 'roles_permissions');

    }

    public function users()
    {

        return $this->belongsToMany(User::class, 'users_permissions');

    }

    public function routes()
    {
        return explode($this->routes, ',');
    }

}
