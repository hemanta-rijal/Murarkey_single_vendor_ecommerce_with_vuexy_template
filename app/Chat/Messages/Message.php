<?php

namespace Musonza\Chat\Messages;


use Illuminate\Database\Eloquent\Model;
use Musonza\Chat\Chat;
use Musonza\Chat\Notifications\MessageNotification;

class Message extends Model
{
    protected $fillable = ['body', 'user_id', 'type', 'deleted'];

    protected $appends = ['formated_created_at'];

    protected $table = 'messages';


    public function sender()
    {
        return $this->belongsTo(Chat::userModel(), 'user_id');
    }

    public function conversation()
    {
        return $this->belongsTo('Musonza\Chat\Conversations\Conversation', 'conversation_id');
    }


    /**
     * Deletes a message
     *
     * @param      integer $messageId
     * @param      integer $userId
     *
     * @return
     */
    public function trash($messageId, $userId)
    {
        return MessageNotification::where('user_id', $userId)
            ->where('message_id', $messageId)
            ->delete();
    }

    public function notification()
    {
        return $this->hasMany(MessageNotification::class);
    }

    /**
     * marks message as read
     *
     * @param      integer $messageId
     * @param      integer $userId
     *
     * @return
     */
    public function messageRead($messageId, $userId)
    {
        return MessageNotification::where('user_id', $userId)
            ->where('message_id', $messageId)
            ->update(['is_seen' => 1]);
    }

    public function getBodyAttribute()
    {
        $body = $this->attributes['body'];

        if ($this->attributes['deleted'])
            return "<i>Message removed</i>";
        
        return $this->type == 'attachment' ? '<a target="_blank" href="' . map_storage_path_to_link($body) . '">Attachment</a>' : e($body);
    }

    public function getFormatedCreatedAtAttribute()
    {
        return $this->created_at->toDayDateTimeString();
    }

    public function getAttachmentLinkAttribute()
    {
        return $this->type == 'attachment' ? map_storage_path_to_link($this->body) : null;
    }
}
