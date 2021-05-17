<?php


namespace Modules\MessageCenter\Contracts;


interface SystemMessageRepository
{

    public function getPaginated($getPaginationConstant);

    public function delete($id);

    public function findById($id);

    public function update($id, $data);

    public function create($data);

    public function getMessagesForRole($role);

    public function getMessagesForRoleWithSenderId($role, $senderId);

    public function markMessage($senderId, $userId, $status, $auto_change);

    public function getUnreadMessageCount($userId);
}