<?php


namespace Modules\MessageCenter\Contracts;


interface MessageService
{
    public function storeGeneralMessage($data);

    public function createConversation($data);

    public function getChatAppData();

    public function markAsRead($conversation_id, $userId = null);

    public function loadMore($conversationId, $skip, $userId = null, $number = 20);

    public function getConversationsByUserId($userId = null);

    public function getSentMessages($userId = null);

    public function getConversationById($id, $userId = null);

    public function postConversations($data);

    public function deleteConversation($id);

    public function markAsUnreadConversation($id, $userId = null);

    public function deleteMessage($messageId, $conversationId, $userId = null);

    public function hideConversation($conversationId, $userId = null);
}