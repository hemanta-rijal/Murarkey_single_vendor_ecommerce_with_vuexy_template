<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MsgInvitation
 */
class MsgInvitation extends Model
{
    protected $table = 'msg_invitation';

    public $timestamps = false;

    protected $fillable = [
        'from',
        'to',
        'company_id',
        'status'
    ];

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'to');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}