<?php


namespace Modules\MessageCenter\Contracts;


interface SystemMessageService
{

    public function getPaginated();

    public function create($data);

    public function findById($id);

    public function update($id, $data);

    public function delete($id);

    public function getMessagesForUser();

    public function getMessagesFormSenderId($id);

    public function markMessageAsRead($senderId, $autoChange = false);
}