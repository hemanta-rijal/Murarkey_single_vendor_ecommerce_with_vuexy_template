<?php

namespace App\Models;

use App\Models\Role;
use App\Notifications\AdminResetPassword;
use App\Traits\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use Notifiable, HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'profile_pic_position' => 'json',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }

    /**
     * Get the role associated with the AdminUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function getProfilePicUrlAttribute()
    {

        return $this->attributes['profile_pic'] ? map_storage_path_to_link(get_cropped_image_path($this->attributes['profile_pic'])) : asset('/assets/img/default-avatar.png');
    }

    public function getRawProfilePicAttribute()
    {
        return $this->attributes['profile_pic'] ? map_storage_path_to_link($this->attributes['profile_pic']) : asset('/assets/img/default-avatar.png');
    }

    public function getPicPositionAttribute()
    {
        return $this->profile_pic_position['position_x'] . ' ' . $this->profile_pic_position['position_y'];
    }
}
