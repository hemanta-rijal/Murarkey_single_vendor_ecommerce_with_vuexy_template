<?php

namespace App\Models;

use App\Models\AdminUser;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name', 'slug'];
    public function permissions()
    {

        return $this->belongsToMany(Permission::class, 'roles_permissions');

    }

    public function users()
    {
        return $this->belongsToMany(AdminUser::class, 'users_roles');

    }
}
