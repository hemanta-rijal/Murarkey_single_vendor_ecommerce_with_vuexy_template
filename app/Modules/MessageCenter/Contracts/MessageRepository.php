<?php


namespace Modules\MessageCenter\Contracts;


interface MessageRepository
{
    public function loadMore($userId, $conversationId, $skip, $number);

    public function getConversationById($id, $userId);

    public function deleteConversations($ids, $userId);

    public function markAsUnread($id, $userId);

    public function deleteMessage($messageId, $conversationId, $userId);

    public function hideConversation($conversationId, $userId);

    public function unHideConversation($conversationId, $users = []);
}