<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Modules\MessageCenter\Contracts\InvitationMessageService;
use Modules\MessageCenter\Contracts\MessageService;
use Modules\MessageCenter\Contracts\SystemMessageService;
use Modules\MessageCenter\Requests\AcceptInvitationRequest;
use Modules\MessageCenter\Requests\CancelInvitationRequest;


class MessageCenterController extends Controller
{
    protected $invitationMessageService;
    protected $messageService;
    protected $systemMessageService;

    public function __construct(InvitationMessageService $invitationMessageService, MessageService $messageService, SystemMessageService $systemMessageService)
    {
        $this->invitationMessageService = $invitationMessageService;
        $this->messageService = $messageService;
        $this->systemMessageService = $systemMessageService;
    }

    public function conversations()
    {
        $conversations = $this->messageService->getConversationsByUserId();

        return view('user.message-center.conversations', compact('conversations'));
    }

    public function postConversations(Request $request)
    {
        $data = $request->all();

        $this->messageService->postConversations($data);

        return back();
    }

    public function conversation($id)
    {
        $conversation = $this->messageService->getConversationById($id);

        $this->messageService->markAsRead($id);

        return view('user.message-center.conversation', compact('conversation'));
    }

    public function deleteConversation($id)
    {
        $this->messageService->deleteConversation($id);

        return redirect('/user/message-center/conversations');
    }

    public function updateConversation($id)
    {
        $this->messageService->markAsUnreadConversation($id);

        return back();
    }

    public function systemNews()
    {
        $messages = $this->systemMessageService->getMessagesForUser();
        
        return view('user.message-center.system-news', compact('messages'));
    }

    public function singleSystemNews($id)
    {
        $messages = $this->systemMessageService->getMessagesFormSenderId($id);

        if ($messages->count() == 0)
            throw new ModelNotFoundException();

        $notification = $messages->first()->notification;



        if(!$notification || $notification->auto_change_status) {
            $notification = $this->systemMessageService->markMessageAsRead($id, false);

            $messages->first()->setRelation('notification', $notification);
        }




        return view('user.message-center.system-news-single', compact('messages'));

    }

    public function updateSingleSystemNews($senderId)
    {
        $this->systemMessageService->markMessageAsRead($senderId);

        return back();
    }


    public function sentMessages()
    {
        $conversations = $this->messageService->getSentMessages();

        return view('user.message-center.sent-messages', compact('conversations'));
    }


    public function trash()
    {
        return view('user.message-center.trash');
    }

    public function inviteRequests()
    {
        $invitations = auth()->user()->invitations;


        return view('user.message-center.invite-requests', compact('invitations'));
    }

    public function acceptInvitation(AcceptInvitationRequest $request)
    {
        $this->invitationMessageService->acceptInvitation($request->get('id'));

        session()->flash('accepted_invitation', $request->get('index'));
        session()->flash('accepted_invitation_logo', $request->get('logo'));

        return back();
    }

    public function deleteInvitation(CancelInvitationRequest $request)
    {
        $this->invitationMessageService->deleteForUser($request->get('id'));

        return back();
    }

    public function markAllInvitationAsRead()
    {
        $this->invitationMessageService->markAllInvitationAsRead();
    }
}
