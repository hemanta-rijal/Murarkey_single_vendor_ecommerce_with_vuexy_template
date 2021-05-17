<?php


namespace Modules\MessageCenter\Repositories;


use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\MessageCenter\Contracts\MessageRepository;
use Musonza\Chat\Conversations\Conversation;
use Musonza\Chat\Conversations\ConversationUser;
use Musonza\Chat\Messages\Message;
use Musonza\Chat\Notifications\MessageNotification;

class DbMessageRepository implements MessageRepository
{

    public function loadMore($userId, $conversationId, $skip, $number)
    {
        $conversationUser = ConversationUser::getConversationUser($userId, $conversationId);

        if ($conversationUser) {
            $messages = Message::where('conversation_id', $conversationId)
                ->orderBy('id', 'DESC')
                ->when($conversationUser->deleted_at, function ($query) use ($conversationUser) {
                    return $query->where('created_at', '>', $conversationUser->deleted_at);
                })
                ->skip($skip)
                ->take($number)
                ->get();

            return $messages->reverse();
        }

        throw new AuthorizationException;
    }

    public function getConversationById($id, $userId)
    {
        $conversation = Conversation::join('conversation_user', 'conversation_user.conversation_id', '=', 'conversations.id')
            ->select('conversations.*', 'conversation_user.deleted_at', 'conversation_user.trash')
            ->where('conversations.id', $id)
            ->join('users', 'conversation_user.user_id', '=', 'users.id')
            ->where('conversation_user.user_id', $userId)
            ->with(['users' => function ($query) use ($userId) {
                $query->where('user_id', '<>', $userId);

                $query->select('id', 'first_name', 'last_name', 'profile_pic', 'role');
            }])
            ->firstOrFail();


        $conversation->load(['messages' => function ($query) use ($conversation) {
            $query->latest();
            if ($conversation->deleted_at)
                $query->where('created_at', '>', $conversation->deleted_at);

            $query->take(10);

            return $query;
        }]);

        if ($conversation->users->count() == 0)
            $conversation->users->push(null_user());

        return $conversation;
    }

    public function deleteConversations($ids, $userId)
    {
        return ConversationUser::whereIn('conversation_id', $ids)->where('user_id', $userId)->update(['deleted_at' => Carbon::now(), 'trash' => 1]);
    }

    public function markAsUnread($id, $userId)
    {
        return MessageNotification::where('user_id', $userId)
            ->where('conversation_id', $id)
            ->update(['is_seen' => 0]);
    }

    public function deleteMessage($messageId, $conversationId, $userId)
    {
        $date = Carbon::now()->subHour(2);

        $message = Message::whereId($messageId)->where('conversation_id', $conversationId)->where('user_id', $userId)->where('created_at', '>', $date)->first();
        if ($message) {
            $message->deleted = 1;
            $message->save();

            return $message;
        }

        return false;
    }

    public function hideConversation($conversationId, $userId)
    {
        return ConversationUser::where('conversation_id', $conversationId)->where('user_id', $userId)->update(['hide_on_chat_box' => true]);
    }

    public function unHideConversation($conversationId, $users = [])
    {
        return ConversationUser::where('conversation_id', $conversationId)->when(count($users), function ($query) use ($users) {
            return $query->whereIn('user_id', $users);
        })->update(['hide_on_chat_box' => false]);
    }
}