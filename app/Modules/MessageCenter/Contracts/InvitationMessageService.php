<?php


namespace Modules\MessageCenter\Contracts;


interface InvitationMessageService
{

    public function createInviteRequest($userId);

    public function getInvitedAssociates();

    public function delete($id, $companyId = null);

    public function acceptInvitation($id, $userId = null);

    public function deleteForUser($id);

    public function markAllInvitationAsRead();
}