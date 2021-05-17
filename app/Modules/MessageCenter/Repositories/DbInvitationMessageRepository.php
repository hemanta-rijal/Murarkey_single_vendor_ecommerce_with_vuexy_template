<?php


namespace Modules\MessageCenter\Repositories;


use App\Models\MsgInvitation;
use Modules\MessageCenter\Contracts\InvitationMessageRepository;

class DbInvitationMessageRepository implements InvitationMessageRepository
{

    public function createInviteRequest($userId, $companyId)
    {
        return MsgInvitation::create(['to' => $userId, 'company_id' => $companyId, 'status' => 'unread']);
    }

    public function getInvitedAssociates($companyId)
    {
        $invitations = MsgInvitation::where('company_id', $companyId)
            ->get();

        return $invitations;
    }

    public function delete($id, $companyId)
    {
        return MsgInvitation::whereId($id)->where('company_id', $companyId)->delete();
    }

    public function acceptInvitation($id, $userId)
    {

    }

    public function deleteForUser($id, $userId)
    {
        return MsgInvitation::where('id', $id)->where('to', $userId)->delete();
    }

    public function findByIdWithUserId($id, $userId)
    {
        return MsgInvitation::whereId($id)->where('to', $userId)->firstOrFail();
    }

    public function markAllInvitationAsRead($userId)
    {
        return MsgInvitation::where('to', $userId)->update(['status' => 'read']);
    }

    public function getUnreadCount($userId)
    {
        return MsgInvitation::where('to', $userId)->where('status', 'unread')->count();
    }

    public function getCount($userId)
    {
        return MsgInvitation::where('to', $userId)->count();
    }
}