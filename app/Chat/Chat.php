<?php

namespace Musonza\Chat;

use App\Exceptions\CantCreateConversation;
use Musonza\Chat\Conversations\Conversation;
use Musonza\Chat\Messages\Message;
use Musonza\Chat\Notifications\MessageNotification;

class Chat
{
    public function __construct(
        Conversation $conversation,
        Message $message
    )
    {
        $this->conversation = $conversation;
        $this->message = $message;
    }

    /**
     * Creates a new conversation
     *
     * @param array $participants
     *
     * @return Conversation
     */
    public function createConversation(array $participants = null)
    {
        if(count($participants) < 2)
            throw new CantCreateConversation();
        $conversation = $this->getConversationBetweenUsers($participants[0], $participants[1]);
        
        if ($conversation) {
            $conversation->recently_created = false;

            return $conversation;
        }
        $conversation = $this->conversation->start($participants);
        $conversation->recently_created = true;

        return $conversation;
    }

    /**
     * Returns a new conversation
     *
     * @param int $conversationId
     *
     * @return Conversation
     */
    public function conversation($conversationId)
    {
        return $this->conversation->findOrFail($conversationId);
    }

    /**
     * Add user(s) to a conversation
     *
     * @param int $conversationId
     * @param mixed $userId / array of user ids or an integer
     *
     * @return Conversation
     */
    public function addParticipants($conversationId, $userId)
    {
        return $this->conversation($conversationId)->addParticipants($userId);
    }

    /**
     * Sends a message
     *
     * @param int $conversationId
     * @param string $body
     * @param int $senderId
     *
     * @return
     */
    public function send($data)
    {
        $conversation = $this->conversation->findOrFail($data['conversation_id']);
        unset($data['conversation_id']);

        $message = new Message($data);
        $conversation->messages()->save($message);
        $notification = MessageNotification::make($message, $conversation);
        $conversation->touch();

        return $message;
    }

    /**
     * Remove user(s) from a conversation
     *
     * @param int $conversationId
     * @param mixed $userId / array of user ids or an integer
     *
     * @return Coonversation
     */
    public function removeParticipants($conversationId, $userId)
    {
        return $this->conversation($conversationId)->removeUsers($userId);
    }

    /**
     * Get recent user messages for each conversation
     *
     * @param int $userId
     *
     * @return Message
     */
    public function conversations($userId)
    {
        return $this->conversation->userConversations($userId);
    }

    /**
     * Get messages in a conversation
     *
     * @param int $userId
     * @param int $conversationId
     * @param int $perPage
     * @param int $page
     *
     * @return Message
     */
    public function messages($userId, $conversationId, $perPage = null, $page = null)
    {
        return $this->conversation($conversationId)->getMessages($userId, $perPage, $page);
    }

    /**
     * Deletes message
     *
     * @param      int $messageId
     * @param      int $userId user id
     *
     * @return     void
     */
    public function trash($messageId, $userId)
    {
        return $this->message->trash($messageId, $userId);
    }

    /**
     * clears conversation
     *
     * @param      int $conversationId
     * @param      int $userId
     */
    public function clear($conversationId, $userId)
    {
        return $this->conversation->clear($conversationId, $userId);
    }

    public function messageRead($messageId, $userId)
    {
        return $this->message->messageRead($messageId, $userId);
    }

    public function conversationRead($conversationId, $userId)
    {
        return $this->conversation->conversationRead($conversationId, $userId);
    }

    public function getUnReadConversationCount($userId)
    {
        return $this->conversation->getUnReadConversationCount($userId);
    }

    public function getConversationBetweenUsers($userOne, $userTwo)
    {
        $conversation1 = $this->conversation->basicUserConversations($userOne)->toArray();

        $conversation2 = $this->conversation->basicUserConversations($userTwo)->toArray();

        $common_conversations = $this->getConversationsInCommon($conversation1, $conversation2);

        if (!$common_conversations) {
            return null;
        }

        return $this->conversation->findOrFail($common_conversations[0]);
    }

    private function getConversationsInCommon($conversation1, $conversation2)
    {
        return array_values(array_intersect($conversation1, $conversation2));
    }

    public static function userModel()
    {
        return config('chat.user_model');
    }


}
