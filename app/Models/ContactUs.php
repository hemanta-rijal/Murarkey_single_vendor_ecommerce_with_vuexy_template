<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $fillable = [
        'name',
        'email',
        'website',
        'company_name',
        'subject',
        'message',
        'status',
    ];
    public $timestamps = false;
    protected $table = 'contact_us';
}
