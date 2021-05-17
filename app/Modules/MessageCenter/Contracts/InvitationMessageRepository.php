<?php


namespace Modules\MessageCenter\Contracts;


interface InvitationMessageRepository
{

    public function createInviteRequest($userId, $companyId);

    public function getInvitedAssociates($companyId);

    public function delete($id, $companyId);

    public function acceptInvitation($id, $userId);

    public function deleteForUser($id, $userId);

    public function findByIdWithUserId($id, $userId);

    public function markAllInvitationAsRead($userId);

    public function getUnreadCount($userId);
}