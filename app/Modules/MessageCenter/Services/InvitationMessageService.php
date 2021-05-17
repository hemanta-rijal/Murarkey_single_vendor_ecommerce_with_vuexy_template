<?php


namespace Modules\MessageCenter\Services;


use App\Events\InvitationAccepted;
use Modules\MessageCenter\Contracts\InvitationMessageRepository;
use Modules\MessageCenter\Contracts\InvitationMessageService as InvitationMessageServiceContract;
use Modules\Users\Contracts\UserRepository;

class InvitationMessageService implements InvitationMessageServiceContract
{
    protected $invitationMessageRepository;
    protected $userRepository;

    public function __construct(InvitationMessageRepository $invitationMessageRepository, UserRepository $userRepository)
    {
        $this->invitationMessageRepository = $invitationMessageRepository;

        $this->userRepository = $userRepository;
    }

    public function createInviteRequest($userId)
    {
        $companyId = auth()->user()->seller->company_id;

        return $this->invitationMessageRepository->createInviteRequest($userId, $companyId);
    }

    public function getInvitedAssociates($companyId = null)
    {
        $companyId = $companyId ?? auth()->user()->seller->company_id;

        return $this->invitationMessageRepository->getInvitedAssociates($companyId);
    }

    public function delete($id, $companyId = null)
    {
        $companyId = $companyId ?? auth()->user()->seller->company_id;

        return $this->invitationMessageRepository->delete($id, $companyId);
    }

    public function acceptInvitation($id, $userId = null)
    {
        $userId = $userId ?? auth()->user()->id;

        $invitation = $this->invitationMessageRepository->findByIdWithUserId($id, $userId);
        \DB::transaction(function () use ($invitation) {

            $seller = [
                'user_id' => $invitation->to,
                'company_id' => $invitation->company_id
            ];
            
            $this->userRepository->createSeller($seller);

            $this->userRepository->updateRole($invitation->to, 'associate-seller');
            
            event(new InvitationAccepted($invitation));

            $invitation->delete();
        });
    }

    public function deleteForUser($id)
    {
        $userId = $userId ?? auth()->user()->id;

        return $this->invitationMessageRepository->deleteForUser($id, $userId);
    }

    public function markAllInvitationAsRead()
    {
        $userId = auth()->user()->id;
        
        return $this->invitationMessageRepository->markAllInvitationAsRead($userId);
    }
}