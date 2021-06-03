<?php

namespace App\Models;

use App\Notifications\UserResetPassword;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends BaseUser implements AuthenticatableContract, JWTSubject 
{
    use Notifiable, SoftDeletes, SearchableTrait, CascadeSoftDeletes, Authenticatable;

    const OrdinaryUser = 'ordinary-user';
    const AssociateSeller = 'associate-seller';
    const MainSeller = 'main-seller';
    const DEFAULT_PROFILE_PIC_SIZE = 200;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['seller', 'company'];

    protected $casts = [
        'shipment_details' => 'object',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'verified',
        'role',
        'profile_pic',
        'profile_pic_position',
        'delete_reason',
        'phone_number',
        'shipment_details',
        'sms_verify_token',
        'verified'
    ];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'users.first_name' => 10,
            'users.last_name' => 10,
            'users.email' => 15,
            'users.phone_number' => 15
        ]
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['name', 'profile_pic_url'];

    protected $discountAvailable = null;

    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function isSeller()
    {
        return (bool)strpos($this->role, 'seller');
    }

    public function isAssociateSeller()
    {
        return $this->role == 'associate-seller';
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'owner_id');
    }

    public function isCompanyVerified()
    {
        return $this->seller->company->status != 'pending';
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $token = $this->sms_verify_token;

        $this->notify(new UserResetPassword($token));
    }


    public function invitations()
    {
        return $this->hasMany(MsgInvitation::class, 'to');
    }

    public function getProfilePicUrlAttribute()
    {

        return isset($this->attributes['profile_pic']) && $this->attributes['profile_pic'] ? map_storage_path_to_link(get_cropped_image_path($this->attributes['profile_pic'])) : asset('/assets/img/default-avatar.png');
    }

    public function getRawProfilePicAttribute()
    {
        return isset($this->attributes['profile_pic']) && $this->attributes['profile_pic'] ? map_storage_path_to_link($this->attributes['profile_pic']) : asset('/assets/img/default-avatar.png');
    }
//
//    public function getPicPositionAttribute()
//    {
//        return $this->profile_pic_position['position_x'] . ' ' . $this->profile_pic_position['position_y'];
//    }

    public function setProfilePicPositionAttribute($value)
    {
        $this->attributes['profile_pic_position'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getJWTIdentifier()
    {
        return 'id';
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    public function getDiscountAvailable()
    {
        if ($this->discountAvailable == null) {
            $this->discountAvailable = Subscription::where('email', $this->email)->where('discount_used', 0)->exists();
        }

        return $this->discountAvailable;
    }


    public function getFormattedShipmentAttribute() {
        return sprintf('%s, %s (%s, %s)', $this->shipment_details->name, $this->shipment_details->phone_number,  $this->shipment_details->address,  $this->shipment_details->city);
    }


}
