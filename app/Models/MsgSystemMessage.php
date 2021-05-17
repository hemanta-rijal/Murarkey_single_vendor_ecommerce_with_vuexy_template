<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

/**
 * Class MsgSystemMessage
 */
class MsgSystemMessage extends Model
{
    use SearchableTrait;

    protected $table = 'msg_system_messages';

    protected $fillable = [
        'from',
        'for_role',
        'text',
        'status',
        'subject'
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
            'text' => 10,
            'subject' => 20,
        ]
    ];


    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo(AdminUser::class, 'from');
    }

    public function notification()
    {
        if (auth()->check())
            return $this->hasOne(SystemMessageNotification::class, 'sender_id', 'from')->where('user_id', auth()->user()->id);
        else
            return $this->hasMany(SystemMessageNotification::class, 'sender_id', 'from');
    }
}