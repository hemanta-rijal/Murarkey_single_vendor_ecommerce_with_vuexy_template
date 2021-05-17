<?php

namespace Musonza\Chat\Conversations;


use Illuminate\Database\Eloquent\Model;

class ConversationUser extends Model
{
    protected $table = 'conversation_user';

    protected $fillable = [
        'hide_on_chat_box',
        'conversation_id',
        'user_id'
    ];

    protected $casts = [
        'hide_on_chat_box' => 'boolean'
    ];

    public function conversation()
    {
        return $this->belongsTo('Musonza\Chat\Conversations\Conversation', 'conversation_id');
    }

    public static function getConversationUser($userId, $conversationId)
    {
        return self::where('user_id', $userId)
            ->where('conversation_id', $conversationId)
            ->first();
    }

    public static function isUserBelongConversation($userId, $conversationId)
    {
        $status = self::where('user_id', $userId)
            ->where('conversation_id', $conversationId)
            ->first();

        return (bool)$status;
    }
}
